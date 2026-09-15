<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

/**
 * @group Authentication
 */
class UserApiController extends Controller
{
    /**
     * Data user saat ini
     *
     * Mengambil data user yang sedang login berdasarkan token.
     *
     * @authenticated
     */
    public function show(Request $request)
    {
        return response()->json($request->user());
    }
}