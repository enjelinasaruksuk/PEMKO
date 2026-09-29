<?php

namespace App\Http\Controllers\UnitLayanan;

use App\Http\Controllers\Controller;
use App\Http\Requests\UnitLayanan\StoreSkRequest;
use App\Http\Requests\UnitLayanan\UpdateSkRequest;
use App\Http\Requests\UnitLayanan\UpdateSkStatusRequest;
use App\Models\Pelayanan;
use App\Models\Sk;
use App\Traits\ResolvesInstansiId;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class SkController extends Controller
{
    use ResolvesInstansiId;

    public function index(): View
    {
        $skList = Sk::query()
            ->milikInstansi($this->currentInstansiId())
            ->with('instansi')
            ->withCount('pelayanan')
            ->latest('tanggal_sk')
            ->get();

        $namaUnit = auth()->user()->instansi?->nama_instansi ?? 'Unit Layanan';

        return view('pages.unit-layanan.sk.index', compact('skList', 'namaUnit'));
    }

    public function create(): View
    {
        return view('pages.unit-layanan.sk.create');
    }

    public function store(StoreSkRequest $request): RedirectResponse
    {
        Sk::create([
            ...$request->validated(),
            'id_instansi' => $this->currentInstansiId(),
        ]);

        return redirect()
            ->route('unit_layanan.sk.index')
            ->with('success', 'Data SK berhasil disimpan.');
    }

    public function edit(Sk $sk): View
    {
        $this->authorizeOwnership($sk);

        return view('pages.unit-layanan.sk.edit', ['sk' => $sk]);
    }

    public function update(UpdateSkRequest $request, Sk $sk): RedirectResponse
    {
        $this->authorizeOwnership($sk);

        // SK yang sudah disetujui tidak boleh diubah lagi dari sisi unit layanan.
        abort_if(
            $sk->status !== 'Aktif' || ! $sk->isEditableByOwner(),
            403,
            'SK yang sedang diperiksa atau sudah disetujui tidak dapat diubah.'
        );

        $sk->update($request->validated());

        return redirect()
            ->route('unit_layanan.sk.index')
            ->with('success', 'Data SK berhasil diperbarui. Kirim kembali ke Admin setelah siap.');
    }

    public function updateStatus(UpdateSkStatusRequest $request, Sk $sk): RedirectResponse
    {
        $this->authorizeOwnership($sk);
        abort_if(! $sk->isEditableByOwner(), 403, 'Status SK tidak dapat diubah saat sedang dalam proses pemeriksaan.');

        $sk->update($request->validated());

        return redirect()
            ->route('unit_layanan.sk.index')
            ->with('success', 'Status SK berhasil diperbarui.');
    }

    public function layanan(Sk $sk): View
    {
        $this->authorizeOwnership($sk);

        $layananTerpilih = $sk->pelayanan()->orderBy('nama_layanan')->get();
        $layananTersedia = Pelayanan::query()
            ->milikInstansi($this->currentInstansiId())
            ->whereDoesntHave('sks', fn ($query) => $query->where('status', 'Aktif'))
            ->orderBy('nama_layanan')
            ->get();

        return view('pages.unit-layanan.sk.layanan', compact(
            'sk',
            'layananTerpilih',
            'layananTersedia'
        ));
    }

    public function attachLayanan(Sk $sk, Pelayanan $pelayanan): RedirectResponse
    {
        $this->authorizeOwnership($sk);
        $this->authorizePelayananOwnership($pelayanan);
        $this->authorizeLayananChanges($sk);

        abort_if(
            $sk->pelayanan()->whereKey($pelayanan->id)->exists(),
            409,
            'Layanan ini sudah tercatat pada SK tersebut.'
        );
        abort_if(
            $pelayanan->sks()
                ->where('sk.id', '!=', $sk->id)
                ->where('status', 'Aktif')
                ->exists(),
            409,
            'Layanan ini sudah tercatat pada SK aktif lain.'
        );

        DB::transaction(fn () => $sk->pelayanan()->attach($pelayanan->id));

        return back()->with('success', 'Layanan berhasil ditambahkan ke SK.');
    }

    public function detachLayanan(Sk $sk, Pelayanan $pelayanan): RedirectResponse
    {
        $this->authorizeOwnership($sk);
        $this->authorizePelayananOwnership($pelayanan);
        $this->authorizeLayananChanges($sk);
        abort_unless($sk->pelayanan()->whereKey($pelayanan->id)->exists(), 404);

        $sk->pelayanan()->detach($pelayanan->id);

        return back()->with('success', 'Layanan dikembalikan ke daftar layanan yang belum memiliki SK.');
    }

    public function destroyLayanan(Sk $sk, Pelayanan $pelayanan): RedirectResponse
    {
        $this->authorizeOwnership($sk);
        $this->authorizePelayananOwnership($pelayanan);
        $this->authorizeLayananChanges($sk);
        abort_unless($sk->pelayanan()->whereKey($pelayanan->id)->exists(), 404);
        abort_if(
            $pelayanan->sks()->where('sk.id', '!=', $sk->id)->exists()
                || $pelayanan->sks()->where('pengesahan', 'Sudah disetujui')->exists(),
            403,
            'Layanan yang digunakan oleh SK lain atau SK yang sudah disahkan tidak dapat dihapus.'
        );

        $pelayanan->delete();

        return back()->with('success', 'Data layanan berhasil dihapus.');
    }

    public function updateKonfirmasi(Request $request, Sk $sk): RedirectResponse
    {
        $this->authorizeOwnership($sk);
        abort_if($sk->status !== 'Aktif', 403, 'Catatan hanya dapat diubah pada SK aktif.');
        abort_if(
            $sk->konfirmasi === 'Sudah disetujui',
            403,
            'Catatan konfirmasi yang sudah disetujui tidak dapat diubah.'
        );

        $validated = $request->validate([
            'catatan_konfirmasi' => ['nullable', 'string', 'max:5000'],
        ]);

        $sk->update($validated);

        return redirect()
            ->route('unit_layanan.sk.index')
            ->with('success', 'Catatan konfirmasi berhasil diperbarui.');
    }

    public function submit(Sk $sk): RedirectResponse
    {
        $this->authorizeOwnership($sk);
        abort_if($sk->status !== 'Aktif', 422, 'SK harus aktif sebelum dikirim ke Admin.');
        abort_unless($sk->isEditableByOwner(), 403, 'SK sedang dalam proses pemeriksaan atau sudah disetujui.');
        abort_unless($sk->pelayanan()->exists(), 422, 'Pilih minimal satu layanan sebelum mengirim SK ke Admin.');

        $sk->update([
            'review_status' => Sk::REVIEW_PENDING_ADMIN,
            'submitted_at' => Carbon::now(),
            'admin_reviewed_at' => null,
            'pengesahan' => 'Belum disetujui',
            'konfirmasi' => 'Menunggu',
            'ttd_nama' => null,
            'ttd_nip' => null,
            'ttd_pangkat' => null,
            'ttd_jabatan' => null,
        ]);

        return redirect()
            ->route('unit_layanan.sk.index')
            ->with('success', 'SK berhasil dikirim ke Admin untuk diperiksa.');
    }

    public function destroy(Sk $sk): RedirectResponse
    {
        $this->authorizeOwnership($sk);

        abort_if(
            $sk->status !== 'Aktif' || ! $sk->isEditableByOwner(),
            403,
            'SK yang sedang diperiksa atau sudah disetujui tidak dapat dihapus.'
        );

        $sk->delete();

        return redirect()
            ->route('unit_layanan.sk.index')
            ->with('success', 'Data SK berhasil dihapus.');
    }

    /**
     * Pastikan record yang diakses benar-benar milik instansi yang login.
     */
    private function authorizeOwnership(Sk $sk): void
    {
        abort_unless(
            $sk->id_instansi === $this->currentInstansiId(),
            403,
            'Anda tidak memiliki akses ke data SK ini.'
        );
    }

    private function authorizePelayananOwnership(Pelayanan $pelayanan): void
    {
        abort_unless(
            $pelayanan->id_instansi === $this->currentInstansiId(),
            403,
            'Anda tidak memiliki akses ke data pelayanan ini.'
        );
    }

    private function authorizeLayananChanges(Sk $sk): void
    {
        abort_if($sk->status !== 'Aktif', 403, 'Layanan hanya dapat diubah pada SK aktif.');
        abort_if(
            ! $sk->isEditableByOwner(),
            403,
            'Layanan hanya dapat diubah sebelum SK dikirim atau setelah dikembalikan untuk diperbaiki.'
        );
    }
}
