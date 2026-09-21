<?php

namespace App\Http\Controllers\Api\UnitLayanan;

use App\Http\Controllers\Controller;
use App\Models\Perwali;
use App\Traits\ResolvesInstansiId;
use Illuminate\Http\Request;

/**
 * @group Unit Layanan - Perwali
 *
 * Endpoint untuk mengelola data Peraturan Wali Kota (Perwali) milik instansi yang login.
 */
class PerwaliApiController extends Controller
{
    use ResolvesInstansiId;

    /**
     * Daftar Perwali
     *
     * @authenticated
     *
     * @response 200 {
     *   "data": [
     *     { "id": 1, "tentang": "Peraturan Walikota (Perwali) Kota Batam Nomor 4 Tahun 2025 tentang Perubahan Atas Peraturan Wali Kota Batam Nomor 47 Tahun 2023 Tentang Penyelenggaraan Pengelolaan Tanah Di Atas Hak Pengelolaan Pemerintah Kota Batam" }
     *   ]
     * }
     */
    public function index()
    {
        $data = Perwali::where('id_instansi', $this->currentInstansiId())
            ->latest()
            ->get(['id', 'tentang']);

        return response()->json(['data' => $data]);
    }

    /**
     * Tambah Perwali
     *
     * @authenticated
     *
     * @bodyParam tentang string required Isi lengkap peraturan (nomor, tahun, tentang apa). Example: Peraturan Walikota (Perwali) Kota Batam Nomor 4 Tahun 2025 tentang Perubahan Atas Peraturan Wali Kota Batam Nomor 47 Tahun 2023 Tentang Penyelenggaraan Pengelolaan Tanah Di Atas Hak Pengelolaan Pemerintah Kota Batam
     *
     * @response 201 {
     *   "message": "Peraturan Wali Kota berhasil ditambahkan.",
     *   "data": { "id": 1, "tentang": "Peraturan Walikota (Perwali) Kota Batam Nomor 4 Tahun 2025 tentang Perubahan Atas Peraturan Wali Kota Batam Nomor 47 Tahun 2023 Tentang Penyelenggaraan Pengelolaan Tanah Di Atas Hak Pengelolaan Pemerintah Kota Batam" }
     * }
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'tentang' => ['required', 'string'],
        ]);

        $perwali = Perwali::create([
            'id_instansi' => $this->currentInstansiId(),
            'tentang'     => $validated['tentang'],
        ]);

        return response()->json([
            'message' => 'Peraturan Wali Kota berhasil ditambahkan.',
            'data'    => $perwali,
        ], 201);
    }

    /**
     * Perbarui Perwali
     *
     * @authenticated
     *
     * @urlParam perwali integer required ID Perwali. Example: 1
     * @bodyParam tentang string required Isi lengkap peraturan yang diperbarui. Example: Peraturan Walikota (Perwali) Kota Batam Nomor 4 Tahun 2025 tentang Perubahan Atas Peraturan Wali Kota Batam Nomor 47 Tahun 2023 Tentang Penyelenggaraan Pengelolaan Tanah Di Atas Hak Pengelolaan Pemerintah Kota Batam (revisi)
     *
     * @response 200 {
     *   "message": "Peraturan Wali Kota berhasil diperbarui.",
     *   "data": { "id": 1, "tentang": "Peraturan Walikota (Perwali) Kota Batam Nomor 4 Tahun 2025 tentang Perubahan Atas Peraturan Wali Kota Batam Nomor 47 Tahun 2023 Tentang Penyelenggaraan Pengelolaan Tanah Di Atas Hak Pengelolaan Pemerintah Kota Batam (revisi)" }
     * }
     */
    public function update(Request $request, Perwali $perwali)
    {
        $validated = $request->validate([
            'tentang' => ['required', 'string'],
        ]);

        $perwali->update($validated);

        return response()->json([
            'message' => 'Peraturan Wali Kota berhasil diperbarui.',
            'data'    => $perwali,
        ]);
    }

    /**
     * Hapus Perwali
     *
     * @authenticated
     *
     * @urlParam perwali integer required ID Perwali. Example: 1
     *
     * @response 200 {
     *   "message": "Peraturan Wali Kota berhasil dihapus."
     * }
     */
    public function destroy(Perwali $perwali)
    {
        $perwali->delete();

        return response()->json([
            'message' => 'Peraturan Wali Kota berhasil dihapus.',
        ]);
    }
}