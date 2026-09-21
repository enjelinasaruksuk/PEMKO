<?php

namespace App\Http\Controllers\Api\UnitLayanan;

use App\Http\Controllers\Controller;
use App\Models\Perda;
use App\Traits\ResolvesInstansiId;
use Illuminate\Http\Request;

/**
 * @group Unit Layanan - Perda
 *
 * Endpoint untuk mengelola data Peraturan Daerah (Perda) milik instansi yang login.
 */
class PerdaApiController extends Controller
{
    use ResolvesInstansiId;

    /**
     * Daftar Perda
     *
     * @authenticated
     *
     * @response 200 {
     *   "data": [
     *     { "id": 1, "tentang": "Peraturan Daerah (Perda) Kota Batam Nomor 1 Tahun 2026 tentang Penyelenggaraan Administrasi Kependudukan" }
     *   ]
     * }
     */
    public function index()
    {
        $data = Perda::where('id_instansi', $this->currentInstansiId())
            ->latest()
            ->get(['id', 'tentang']);

        return response()->json(['data' => $data]);
    }

    /**
     * Tambah Perda
     *
     * @authenticated
     *
     * @bodyParam tentang string required Isi lengkap peraturan (nomor, tahun, tentang apa). Example: Peraturan Daerah (Perda) Kota Batam Nomor 1 Tahun 2026 tentang Penyelenggaraan Administrasi Kependudukan
     *
     * @response 201 {
     *   "message": "Peraturan Daerah berhasil ditambahkan.",
     *   "data": { "id": 1, "tentang": "Peraturan Daerah (Perda) Kota Batam Nomor 1 Tahun 2026 tentang Penyelenggaraan Administrasi Kependudukan" }
     * }
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'tentang' => ['required', 'string'],
        ]);

        $perda = Perda::create([
            'id_instansi' => $this->currentInstansiId(),
            'tentang'     => $validated['tentang'],
        ]);

        return response()->json([
            'message' => 'Peraturan Daerah berhasil ditambahkan.',
            'data'    => $perda,
        ], 201);
    }

    /**
     * Perbarui Perda
     *
     * @authenticated
     *
     * @urlParam perda integer required ID Perda. Example: 1
     * @bodyParam tentang string required Isi lengkap peraturan yang diperbarui. Example: Peraturan Daerah (Perda) Kota Batam Nomor 1 Tahun 2026 tentang Penyelenggaraan Administrasi Kependudukan (revisi)
     *
     * @response 200 {
     *   "message": "Peraturan Daerah berhasil diperbarui.",
     *   "data": { "id": 1, "tentang": "Peraturan Daerah (Perda) Kota Batam Nomor 1 Tahun 2026 tentang Penyelenggaraan Administrasi Kependudukan (revisi)" }
     * }
     */
    public function update(Request $request, Perda $perda)
    {
        $validated = $request->validate([
            'tentang' => ['required', 'string'],
        ]);

        $perda->update($validated);

        return response()->json([
            'message' => 'Peraturan Daerah berhasil diperbarui.',
            'data'    => $perda,
        ]);
    }

    /**
     * Hapus Perda
     *
     * @authenticated
     *
     * @urlParam perda integer required ID Perda. Example: 1
     *
     * @response 200 {
     *   "message": "Peraturan Daerah berhasil dihapus."
     * }
     */
    public function destroy(Perda $perda)
    {
        $perda->delete();

        return response()->json([
            'message' => 'Peraturan Daerah berhasil dihapus.',
        ]);
    }
}