<?php

namespace App\Http\Controllers\UnitLayanan;

use App\Http\Controllers\Controller;
use App\Http\Requests\UnitLayanan\StorePelayananRequest;
use App\Http\Requests\UnitLayanan\UpdatePelayananRequest;
use App\Models\Pelayanan;
use App\Models\Sk;
use App\Traits\ResolvesInstansiId;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class PelayananController extends Controller
{
    use ResolvesInstansiId;

    public function index(): View
    {
        $pelayananList = Pelayanan::query()
            ->milikInstansi($this->currentInstansiId())
            ->withExists([
                'sks as has_locked_sk' => fn ($query) => $query->whereIn('review_status', [
                    Sk::REVIEW_PENDING_ADMIN,
                    Sk::REVIEW_PENDING_INSTANSI,
                    Sk::REVIEW_APPROVED,
                ]),
            ])
            ->latest()
            ->get();

        return view('pages.unit-layanan.pelayanan.index', compact('pelayananList'));
    }

    public function create(): View
    {
        return view('pages.unit-layanan.pelayanan.create');
    }

    public function show(Pelayanan $pelayanan): View
    {
        $this->authorizeOwnership($pelayanan);

        return view('pages.unit-layanan.pelayanan.show', compact('pelayanan'));
    }

    public function store(StorePelayananRequest $request): RedirectResponse
    {
        Pelayanan::create([
            ...$request->validated(),
            'id_instansi' => $this->currentInstansiId(),
        ]);

        return redirect()
            ->route('unit_layanan.pelayanan.index')
            ->with('success', 'Data pelayanan berhasil ditambahkan.');
    }

    public function edit(Pelayanan $pelayanan): View
    {
        $this->authorizeOwnership($pelayanan);
        $this->authorizeEditable($pelayanan);

        $data = $pelayanan;

        return view('pages.unit-layanan.pelayanan.edit', compact('data'));
    }

    public function update(UpdatePelayananRequest $request, Pelayanan $pelayanan): RedirectResponse
    {
        $this->authorizeOwnership($pelayanan);
        $this->authorizeEditable($pelayanan);

        $pelayanan->update($request->validated());

        return redirect()
            ->route('unit_layanan.pelayanan.index')
            ->with('success', 'Data pelayanan berhasil diperbarui.');
    }

    public function destroy(Pelayanan $pelayanan): RedirectResponse
    {
        $this->authorizeOwnership($pelayanan);
        $this->authorizeEditable($pelayanan);

        $pelayanan->delete();

        return redirect()
            ->route('unit_layanan.pelayanan.index')
            ->with('success', 'Data pelayanan berhasil dihapus.');
    }

    /**
     * Pastikan record yang diakses benar-benar milik instansi yang login,
     * supaya satu unit layanan tidak bisa mengubah/menghapus data unit lain.
     */
    private function authorizeOwnership(Pelayanan $pelayanan): void
    {
        abort_unless(
            $pelayanan->id_instansi === $this->currentInstansiId(),
            403,
            'Anda tidak memiliki akses ke data pelayanan ini.'
        );
    }

    private function authorizeEditable(Pelayanan $pelayanan): void
    {
        abort_if(
            $pelayanan->sks()->whereIn('review_status', [
                Sk::REVIEW_PENDING_ADMIN,
                Sk::REVIEW_PENDING_INSTANSI,
                Sk::REVIEW_APPROVED,
            ])->exists(),
            403,
            'Layanan yang sedang diproses atau sudah disahkan dalam SK tidak dapat diubah atau dihapus.'
        );
    }
}
