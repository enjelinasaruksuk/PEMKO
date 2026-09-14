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
class AuthApiController extends Controller
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

        if (! $pengguna || ! Auth::validate(['username' => $request->username, 'password' => $request->password])) {
            return response()->json(['message' => 'Username atau kata sandi salah.'], 401);
        }

        $token = $pengguna->createToken('api-token')->plainTextToken;

        return response()->json([
            'message' => 'Login berhasil',
            'token' => $token,
            'user' => $pengguna,
        ]);
    }

    /**
     * Data user saat ini
     *
     * Mengambil data user yang sedang login berdasarkan token.
     *
     * @authenticated
     */
    public function user(Request $request)
    {
        return response()->json($request->user());
    }

    /**
     * Logout
     *
     * Menghapus token akses yang sedang dipakai.
     *
     * @authenticated
     */
    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json(['message' => 'Logout berhasil']);
    }
}