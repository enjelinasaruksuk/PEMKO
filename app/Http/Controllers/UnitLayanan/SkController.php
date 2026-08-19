<?php

namespace App\Http\Controllers\UnitLayanan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SkController extends Controller
{
    /**
     * Menampilkan halaman Pengesahan SK.
     */
    public function index()
    {
        /*
        |--------------------------------------------------------------------------
        | Data sementara
        |--------------------------------------------------------------------------
        | Nanti bagian ini bisa diganti dengan query database.
        */

        $skList = collect([

            (object) [
                'id' => 1,
                'nama_dinas' => 'Bagian Organisasi',
                'no_sk' => '001/2026',
                'tanggal_sk' => '2026-01-10',
                'jenis_sk' => 'SK Baru',
                'no_sk_sebelumnya' => null,
                'status' => 'Aktif',
                'pengesahan' => 'Sudah disetujui',
            ],

            (object) [
                'id' => 2,
                'nama_dinas' => 'Bagian Organisasi',
                'no_sk' => '002/2026',
                'tanggal_sk' => '2026-02-15',
                'jenis_sk' => 'Menggantikan SK Sebelumnya',
                'no_sk_sebelumnya' => '003/2025',
                'status' => 'Aktif',
                'pengesahan' => 'Belum disetujui',
            ],

            (object) [
                'id' => 3,
                'nama_dinas' => 'Bagian Organisasi',
                'no_sk' => '003/2026',
                'tanggal_sk' => '2026-03-20',
                'jenis_sk' => 'SK Baru',
                'no_sk_sebelumnya' => null,
                'status' => 'Tidak Aktif',
                'pengesahan' => 'Belum disetujui',
            ],

        ]);

        return view(
            'pages.unit-layanan.sk.index',
            compact('skList')
        );
    }


    /**
     * Menyimpan data SK.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'no_sk' => ['required', 'string', 'max:255'],
            'tanggal_sk' => ['required', 'date'],
            'jenis_sk' => ['required', 'string', 'max:255'],
            'no_sk_sebelumnya' => ['nullable', 'string', 'max:255'],
        ]);

        /*
        |--------------------------------------------------------------------------
        | Sementara
        |--------------------------------------------------------------------------
        | Nanti bisa diganti dengan:
        | Sk::create($validated);
        */

        return redirect()
            ->route('unit_layanan.sk.index')
            ->with('success', 'Data SK berhasil disimpan.');
    }


    /**
     * Memperbarui data SK.
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'no_sk' => ['required', 'string', 'max:255'],
            'tanggal_sk' => ['required', 'date'],
            'jenis_sk' => ['required', 'string', 'max:255'],
            'no_sk_sebelumnya' => ['nullable', 'string', 'max:255'],
        ]);

        return redirect()
            ->route('unit_layanan.sk.index')
            ->with('success', 'Data SK berhasil diperbarui.');
    }


    /**
     * Memperbarui status SK.
     */
    public function updateStatus(Request $request, $id)
    {
        $validated = $request->validate([
            'status' => ['required', 'in:Aktif,Tidak Aktif'],
        ]);

        return redirect()
            ->route('unit_layanan.sk.index')
            ->with('success', 'Status SK berhasil diperbarui.');
    }


    /**
     * Menghapus data SK.
     */
    public function destroy($id)
    {
        return redirect()
            ->route('unit_layanan.sk.index')
            ->with('success', 'Data SK berhasil dihapus.');
    }
}