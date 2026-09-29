<?php

namespace App\Http\Controllers\Instansi;

use App\Http\Controllers\Controller;
use App\Http\Requests\UnitLayanan\StoreSkRequest;
use App\Http\Requests\UnitLayanan\UpdateSkRequest;
use App\Models\Pelayanan;
use App\Models\Sk;
use App\Traits\ResolvesInstansiId;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class OwnSkController extends Controller
{
    use ResolvesInstansiId;

    public function index(): View
    {
        abort_unless((int) auth()->user()->instansi?->level_instansi === 1, 403);

        $skList = Sk::query()
            ->milikInstansi($this->currentInstansiId())
            ->with('instansi')
            ->withCount('pelayanan')
            ->latest('tanggal_sk')
            ->get();

        return view('pages.instansi.sk.own-index', compact('skList'));
    }

    public function store(StoreSkRequest $request): RedirectResponse
    {
        $this->authorizeLevelOne();
        Sk::create([
            ...$request->validated(),
            'id_instansi' => $this->currentInstansiId(),
        ]);

        return redirect()->route('instansi.own_sk.index')->with('success', 'Data SK berhasil disimpan.');
    }

    public function update(UpdateSkRequest $request, Sk $sk): RedirectResponse
    {
        $this->authorizeOwnership($sk);
        abort_unless($sk->status === 'Aktif' && $sk->isEditableByOwner(), 403, 'SK sedang diperiksa atau sudah disetujui.');

        $sk->update($request->validated());

        return redirect()->route('instansi.own_sk.index')->with('success', 'Data SK berhasil diperbarui.');
    }

    public function destroy(Sk $sk): RedirectResponse
    {
        $this->authorizeOwnership($sk);
        abort_unless($sk->status === 'Aktif' && $sk->isEditableByOwner(), 403, 'SK sedang diperiksa atau sudah disetujui.');

        $sk->delete();

        return redirect()->route('instansi.own_sk.index')->with('success', 'Data SK berhasil dihapus.');
    }

    public function submit(Sk $sk): RedirectResponse
    {
        $this->authorizeOwnership($sk);
        abort_unless($sk->status === 'Aktif', 422, 'SK harus aktif sebelum dikirim ke Admin.');
        abort_unless($sk->isEditableByOwner(), 403, 'SK sedang diperiksa atau sudah disetujui.');
        abort_unless($sk->pelayanan()->exists(), 422, 'Pilih minimal satu layanan sebelum mengirim SK.');

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

        return redirect()->route('instansi.own_sk.index')->with('success', 'SK berhasil dikirim ke Admin untuk diperiksa.');
    }

    public function layanan(Sk $sk): View
    {
        $this->authorizeOwnership($sk);

        $idInstansi = $this->currentInstansiId();
        $layananTerpilih = $sk->pelayanan()->orderBy('nama_layanan')->get();
        $layananTersedia = Pelayanan::query()
            ->milikInstansi($idInstansi)
            ->whereDoesntHave('sks', fn ($query) => $query->where('status', 'Aktif'))
            ->orderBy('nama_layanan')
            ->get();

        return view('pages.unit-layanan.sk.layanan', [
            'sk' => $sk,
            'layananTerpilih' => $layananTerpilih,
            'layananTersedia' => $layananTersedia,
            'layout' => 'layouts.instansi',
            'skRoutePrefix' => 'instansi.own_sk',
            'pelayananRoutePrefix' => 'instansi.pelayanan',
            'namaPemilik' => auth()->user()->instansi?->nama_instansi,
        ]);
    }

    public function attachLayanan(Sk $sk, Pelayanan $pelayanan): RedirectResponse
    {
        $this->authorizeOwnership($sk);
        $this->authorizeService($pelayanan);
        $this->authorizeChanges($sk);
        abort_if($sk->pelayanan()->whereKey($pelayanan->id)->exists(), 409, 'Layanan sudah dipilih.');
        abort_if(
            $pelayanan->sks()->where('sk.id', '!=', $sk->id)->where('status', 'Aktif')->exists(),
            409,
            'Layanan sudah terhubung ke SK aktif lain.'
        );

        DB::transaction(fn () => $sk->pelayanan()->attach($pelayanan->id));

        return back()->with('success', 'Layanan berhasil ditambahkan ke SK.');
    }

    public function detachLayanan(Sk $sk, Pelayanan $pelayanan): RedirectResponse
    {
        $this->authorizeOwnership($sk);
        $this->authorizeService($pelayanan);
        $this->authorizeChanges($sk);
        abort_unless($sk->pelayanan()->whereKey($pelayanan->id)->exists(), 404);

        $sk->pelayanan()->detach($pelayanan->id);

        return back()->with('success', 'Layanan berhasil dikeluarkan dari SK.');
    }

    public function destroyLayanan(Sk $sk, Pelayanan $pelayanan): RedirectResponse
    {
        $this->authorizeOwnership($sk);
        $this->authorizeService($pelayanan);
        $this->authorizeChanges($sk);
        abort_unless($sk->pelayanan()->whereKey($pelayanan->id)->exists(), 404);
        abort_if(
            $pelayanan->sks()->where('sk.id', '!=', $sk->id)->exists()
                || $pelayanan->sks()->where('pengesahan', 'Sudah disetujui')->exists(),
            403,
            'Layanan yang dipakai pada SK lain atau telah disahkan tidak dapat dihapus.'
        );

        $pelayanan->delete();

        return back()->with('success', 'Data layanan berhasil dihapus.');
    }

    private function authorizeLevelOne(): void
    {
        abort_unless((int) auth()->user()->instansi?->level_instansi === 1, 403);
    }

    private function authorizeOwnership(Sk $sk): void
    {
        $this->authorizeLevelOne();
        abort_unless($sk->id_instansi === $this->currentInstansiId(), 403, 'SK bukan milik Instansi ini.');
    }

    private function authorizeService(Pelayanan $pelayanan): void
    {
        abort_unless($pelayanan->id_instansi === $this->currentInstansiId(), 403, 'Layanan bukan milik Instansi ini.');
    }

    private function authorizeChanges(Sk $sk): void
    {
        abort_unless(
            $sk->status === 'Aktif' && $sk->isEditableByOwner(),
            403,
            'Layanan hanya dapat diubah sebelum SK dikirim atau setelah dikembalikan untuk diperbaiki.'
        );
    }
}
