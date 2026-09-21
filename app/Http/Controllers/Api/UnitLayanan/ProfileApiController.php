<?php

namespace App\Http\Controllers\Api\UnitLayanan;

use App\Http\Controllers\Controller;
use App\Models\Perda;
use App\Models\Perwali;
use App\Models\ProfilUnitLayanan;
use App\Traits\ResolvesInstansiId;
use Illuminate\Http\Request;

/**
 * @group Unit Layanan - Profil
 *
 * Endpoint untuk mengelola data Profil Unit Layanan beserta Perda & Perwali terkait.
 */
class ProfileApiController extends Controller
{
    use ResolvesInstansiId;

    /**
     * Ambil data profil
     *
     * Mengambil data profil unit layanan beserta daftar Perda dan Perwali milik instansi yang login.
     *
     * @authenticated
     *
     * @response 200 {
     *   "profile": {
     *     "id": 1,
     *     "id_instansi": 1,
     *     "nama_unit": "Bagian Organisasi",
     *     "nama_kepala": "Drs. Ahmad Fauzi, M.Si",
     *     "jabatan": "Non PLT",
     *     "website": null,
     *     "alamat": "Jln Engku Putri",
     *     "nip": "19750101 200003 1 001",
     *     "pangkat": "Pembina Utama Muda (IV/c)",
     *     "email": "123@gmail.com",
     *     "misi": "bersikap baik",
     *     "telepon": "0899764532109",
     *     "faksimile": "(0778) 123457",
     *     "motto": "bersikap baik",
     *     "visi": "bersikap baik"
     *   },
     *   "perda": [
     *     { "id": 1, "tentang": "Peraturan Daerah (Perda) Kota Batam Nomor 1 Tahun 2026 tentang Penyelenggaraan Administrasi Kependudukan" }
     *   ],
     *   "perwali": [
     *     { "id": 1, "tentang": "Peraturan Walikota (Perwali) Kota Batam Nomor 4 Tahun 2025 tentang Perubahan Atas Peraturan Wali Kota Batam Nomor 47 Tahun 2023 Tentang Penyelenggaraan Pengelolaan Tanah Di Atas Hak Pengelolaan Pemerintah Kota Batam" }
     *   ]
     * }
     */
    public function show(Request $request)
    {
        $idInstansi = $this->currentInstansiId();

        $profile = ProfilUnitLayanan::where('id_instansi', $idInstansi)->first();
        $perda   = Perda::where('id_instansi', $idInstansi)->latest()->get(['id', 'tentang']);
        $perwali = Perwali::where('id_instansi', $idInstansi)->latest()->get(['id', 'tentang']);

        return response()->json([
            'profile' => $profile,
            'perda'   => $perda,
            'perwali' => $perwali,
        ]);
    }

    /**
     * Simpan / perbarui profil
     *
     * @authenticated
     *
     * @bodyParam nama_unit string Nama unit layanan. Example: Bagian Organisasi
     * @bodyParam nama_kepala string Nama kepala dinas/UUP. Example: Drs. Ahmad Fauzi, M.Si
     * @bodyParam jabatan string Salah satu dari: Non PLT, PLT. Example: Non PLT
     * @bodyParam website string Laman/website unit layanan.
     * @bodyParam alamat string Alamat unit layanan.
     * @bodyParam nip string NIP kepala dinas.
     * @bodyParam pangkat string Pangkat kepala dinas.
     * @bodyParam email string Email unit layanan.
     * @bodyParam misi string Misi unit layanan.
     * @bodyParam telepon string Nomor telepon.
     * @bodyParam faksimile string Nomor faksimile.
     * @bodyParam motto string Motto unit layanan.
     * @bodyParam visi string Visi unit layanan.
     *
     * @response 200 {
     *   "message": "Data profil berhasil disimpan.",
     *   "profile": { "id": 1, "id_instansi": 1, "nama_unit": "Bagian Organisasi" }
     * }
     */
    public function update(Request $request)
    {
        $validated = $request->validate([
            'nama_unit'   => ['nullable', 'string', 'max:255'],
            'nama_kepala' => ['nullable', 'string', 'max:255'],
            'jabatan'     => ['nullable', 'in:Non PLT,PLT'],
            'website'     => ['nullable', 'string', 'max:255'],
            'alamat'      => ['nullable', 'string'],
            'nip'         => ['nullable', 'string', 'max:50'],
            'pangkat'     => ['nullable', 'string', 'max:100'],
            'email'       => ['nullable', 'email', 'max:255'],
            'misi'        => ['nullable', 'string'],
            'telepon'     => ['nullable', 'string', 'max:50'],
            'faksimile'   => ['nullable', 'string', 'max:50'],
            'motto'       => ['nullable', 'string'],
            'visi'        => ['nullable', 'string'],
        ]);

        $profile = ProfilUnitLayanan::updateOrCreate(
            ['id_instansi' => $this->currentInstansiId()],
            $validated
        );

        return response()->json([
            'message' => 'Data profil berhasil disimpan.',
            'profile' => $profile,
        ]);
    }
}