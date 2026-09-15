<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Pengguna;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

/**
 * @group Authentication
 *
 * Endpoint untuk login, logout, dan cek data user yang sedang login.
 */
class LoginApiController extends Controller
{
    /**
     * Login
     *
     * Login menggunakan username dan password, mengembalikan token akses.
     *
     * @bodyParam username string required Username pengguna. Example: admin
     * @bodyParam password string required Kata sandi pengguna. Example: password123
     *
     * @response 200 {
     *   "message": "Login berhasil",
     *   "token": "1|xxxxxxxxxxxxxxxxxxxx",
     *   "user": {
     *     "id_pengguna": 1,
     *     "nama_pengguna": "Admin Utama",
     *     "username": "admin"
     *   }
     * }
     * @response 401 {
     *   "message": "Username atau kata sandi salah."
     * }
     */
    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        $pengguna = Pengguna::where('username', $request->username)->first();

        if (! $pengguna || $pengguna->status !== 'aktif') {
            return response()->json(['message' => 'Akun tidak ditemukan atau belum aktif.'], 401);
        }

        if (! Auth::validate(['username' => $request->username, 'password' => $request->password])) {
            return response()->json(['message' => 'Username atau kata sandi salah.'], 401);
        }

        $pengguna->update(['masuk_terakhir' => now()]);

        $token = $pengguna->createToken('api-token')->plainTextToken;

        return response()->json([
            'message' => 'Login berhasil',
            'token' => $token,
            'user' => $pengguna,
        ]);
    }
}