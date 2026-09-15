<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

/**
 * @group Authentication
 */
class LogoutApiController extends Controller
{
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