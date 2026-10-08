<?php

namespace App\Http\Controllers\Instansi;

use App\Http\Controllers\Controller;
use App\Http\Requests\UnitLayanan\StorePelayananRequest;
use App\Http\Requests\UnitLayanan\UpdatePelayananRequest;
use App\Models\DetailPelayanan;
use App\Models\KomponenPelayanan;
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
        $pelayananList = Pelayanan::milikInstansi($this->currentInstansiId())
            ->withExists([
                'sks as has_locked_sk' => fn ($query) => $query->whereIn('review_status', [
                    Sk::REVIEW_PENDING_ADMIN,
                    Sk::REVIEW_PENDING_INSTANSI,
                    Sk::REVIEW_APPROVED,
                ]),
            ])
            ->latest()
            ->get();

        return view('pages.instansi.pelayanan.index', compact('pelayananList'));
    }

    public function create(): View
    {
        $komponenList = KomponenPelayanan::orderBy('kategori')->get()->groupBy('kategori');

        return view('pages.instansi.pelayanan.create', compact('komponenList'));
    }

    public function show(Pelayanan $pelayanan): View
    {
        $this->authorizeOwnership($pelayanan);

        $pelayanan->load('details.komponen');

        return view('pages.unit-layanan.pelayanan.show', [
            'pelayanan' => $pelayanan,
            'layout' => 'layouts.instansi',
        ]);
    }

    public function store(StorePelayananRequest $request): RedirectResponse
    {
        $pelayanan = Pelayanan::create([
            'id_instansi' => $this->currentInstansiId(),
            'nama_layanan' => $request->validated()['nama_layanan'],
        ]);

        $this->syncKomponen($pelayanan, $request->input('komponen', []));

        return redirect()->route('instansi.pelayanan.index')
            ->with('success', 'Data pelayanan berhasil ditambahkan.');
    }

    public function edit(Pelayanan $pelayanan): View
    {
        $this->authorizeOwnership($pelayanan);
        $this->authorizeEditable($pelayanan);

        $komponenList = KomponenPelayanan::orderBy('kategori')->get()->groupBy('kategori');
        $komponenMap = $pelayanan->komponenMap();
        $data = $pelayanan;

        return view('pages.instansi.pelayanan.edit', compact('data', 'komponenList', 'komponenMap'));
    }

    public function update(UpdatePelayananRequest $request, Pelayanan $pelayanan): RedirectResponse
    {
        $this->authorizeOwnership($pelayanan);
        $this->authorizeEditable($pelayanan);

        $pelayanan->update([
            'nama_layanan' => $request->validated()['nama_layanan'],
        ]);

        $this->syncKomponen($pelayanan, $request->input('komponen', []));

        return redirect()->route('instansi.pelayanan.index')
            ->with('success', 'Data pelayanan berhasil diperbarui.');
    }

    public function destroy(Pelayanan $pelayanan): RedirectResponse
    {
        $this->authorizeOwnership($pelayanan);
        $this->authorizeEditable($pelayanan);

        $pelayanan->delete();

        return redirect()->route('instansi.pelayanan.index')
            ->with('success', 'Data pelayanan berhasil dihapus.');
    }

    /**
     * Simpan/update isi tiap komponen untuk pelayanan ini.
     * $komponenInput format: [id_komponen => isi_komponen, ...]
     */
    private function syncKomponen(Pelayanan $pelayanan, array $komponenInput): void
    {
        foreach ($komponenInput as $idKomponen => $isi) {
            if (trim((string) $isi) === '') {
                continue;
            }

            DetailPelayanan::updateOrCreate(
                ['id_pelayanan' => $pelayanan->id, 'id_komponen' => $idKomponen],
                ['isi_komponen' => $isi]
            );
        }
    }

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