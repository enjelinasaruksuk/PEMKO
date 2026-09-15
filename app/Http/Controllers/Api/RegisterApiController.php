<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Instansi;
use App\Models\Pengguna;
use App\Models\Role;
use Illuminate\Http\Request;

/**
 * @group Authentication
 */
class RegisterApiController extends Controller
{
    /**
     * Ajukan Akun Baru
     *
     * Mengajukan akun baru untuk instansi/unit layanan. Status awal "pending", menunggu persetujuan admin.
     *
     * @bodyParam level_akun integer required Level akun, 1 atau 2. Example: 2
     * @bodyParam instansi_level_1 integer required ID instansi level 1. Example: 1
     * @bodyParam instansi_level_2 integer ID instansi level 2, wajib jika level_akun = 2. Example: 3
     * @bodyParam email string required Email pemohon. Example: organisasi@batam.go.id
     *
     * @response 201 {
     *   "message": "Pengajuan akun berhasil dikirim. Menunggu persetujuan admin."
     * }
     * @response 422 {
     *   "message": "Instansi ini sudah punya pengajuan yang masih menunggu persetujuan."
     * }
     */
    public function register(Request $request)
    {
        $request->validate([
            'level_akun' => 'required|in:1,2',
            'instansi_level_1' => 'required|exists:instansi,id_instansi',
            'instansi_level_2' => $request->level_akun == 2 ? 'required|exists:instansi,id_instansi' : 'nullable',
            'email' => 'required|email',
        ]);

        $levelAkun = (int) $request->level_akun;
        $idInstansiTerpilih = $levelAkun === 2
            ? $request->instansi_level_2
            : $request->instansi_level_1;

        $instansiTerpilih = Instansi::findOrFail($idInstansiTerpilih);

        $sudahAda = Pengguna::where('id_instansi', $instansiTerpilih->id_instansi)
            ->where('status', 'pending')
            ->exists();

        if ($sudahAda) {
            return response()->json([
                'message' => 'Instansi ini sudah punya pengajuan yang masih menunggu persetujuan.',
            ], 422);
        }

        $roleName = $levelAkun === 2 ? 'unit_layanan' : 'instansi';
        $role = Role::where('nama_role', $roleName)->first();

        if (! $role) {
            return response()->json(['message' => 'Role belum tersedia di sistem.'], 500);
        }

        Pengguna::create([
            'id_role' => $role->id_role,
            'id_instansi' => $instansiTerpilih->id_instansi,
            'nama_pengguna' => $instansiTerpilih->nama_instansi,
            'email' => $request->email,
            'username' => null,
            'password' => null,
            'status' => 'pending',
        ]);

        return response()->json([
            'message' => 'Pengajuan akun berhasil dikirim. Menunggu persetujuan admin.',
        ], 201);
    }
}