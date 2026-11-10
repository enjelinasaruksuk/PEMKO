<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Maklumat;
use App\Models\ProfilUnitLayanan;
use App\Models\Sk;
use App\Models\TandaTangan;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\View\View;

class TandaTanganController extends Controller
{
    public function index(): View
    {
        // NIP profil dibersihkan jadi angka saja, sama seperti saat approval SK.
        $profilMap = ProfilUnitLayanan::with('instansi')->get()
            ->filter(fn ($profil) => filled($profil->nip))
            ->keyBy(fn ($profil) => preg_replace('/\D/', '', $profil->nip));

        // Kolom gambar (berat) tidak ikut dimuat; cukup dicek ada/tidaknya.
        $ttdList = TandaTangan::query()
            ->select('nip', 'updated_at')
            ->selectRaw("(gambar IS NOT NULL AND gambar <> '') as punya_gambar")
            ->orderBy('nip')
            ->get()
            ->map(function (TandaTangan $ttd) use ($profilMap) {
                $profil = $profilMap->get($ttd->nip);

                return (object) [
                    'model' => $ttd,
                    'nip' => $ttd->nip,
                    'file_ada' => (bool) $ttd->punya_gambar,
                    'nama' => $profil?->nama_kepala,
                    'instansi' => $profil?->instansi?->nama_instansi,
                    'diperbarui' => $ttd->updated_at,
                ];
            });

        return view('pages.admin.tanda_tangan.index', compact('ttdList'));
    }

    public function store(Request $request): RedirectResponse
    {
        // Spasi/titik pada NIP dibuang sebelum divalidasi.
        $request->merge(['nip' => preg_replace('/\D/', '', (string) $request->input('nip'))]);

        $validated = $request->validate([
            'nip' => ['required', 'digits:18'],
            'file' => ['required', 'file', 'mimes:png', 'mimetypes:image/png', 'max:1024'],
        ], [
            'nip.digits' => 'NIP harus tepat 18 digit angka.',
            'file.mimes' => 'Tanda tangan harus berupa file PNG.',
            'file.mimetypes' => 'Tanda tangan harus berupa file PNG.',
            'file.max' => 'Ukuran file maksimal 1 MB.',
        ]);

        $nip = $validated['nip'];
        $sudahAda = TandaTangan::whereKey($nip)->exists();

        $gambar = base64_encode(file_get_contents($request->file('file')->getRealPath()));

        // Unggah ulang untuk NIP yang sama otomatis mengganti gambar lama.
        TandaTangan::updateOrCreate(['nip' => $nip], ['gambar' => $gambar, 'path' => null]);

        return redirect()
            ->route('admin.tanda_tangan.index')
            ->with('success', $sudahAda
                ? 'Spesimen tanda tangan berhasil diganti.'
                : 'Spesimen tanda tangan berhasil ditambahkan.');
    }

    public function show(TandaTangan $tandaTangan): Response
    {
        abort_unless(filled($tandaTangan->gambar), 404);

        return response(base64_decode($tandaTangan->gambar), 200, [
            'Content-Type' => 'image/png',
            'Cache-Control' => 'private, max-age=0, must-revalidate',
        ]);
    }

    public function destroy(TandaTangan $tandaTangan): RedirectResponse
    {
        $nip = $tandaTangan->nip;

        $dipakaiSk = Sk::whereNotNull('ttd_nip')->pluck('ttd_nip')
            ->contains(fn ($ttdNip) => preg_replace('/\D/', '', $ttdNip) === $nip);

        $dipakaiMaklumat = Maklumat::where('nip_penjabat', $nip)->exists();

        if ($dipakaiSk || $dipakaiMaklumat) {
            return redirect()
                ->route('admin.tanda_tangan.index')
                ->withErrors(['ttd' => 'Spesimen ini sudah dipakai pada SK atau Maklumat, sehingga tidak dapat dihapus. Unggah ulang untuk menggantinya.']);
        }

        $tandaTangan->delete();

        return redirect()
            ->route('admin.tanda_tangan.index')
            ->with('success', 'Spesimen tanda tangan dihapus.');
    }
}