<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\PdfController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

require __DIR__.'/admin.php';
require __DIR__.'/instansi.php';
require __DIR__.'/unit_layanan.php';

Route::get('/', function () {
    if (! Auth::check()) {
        return redirect()->route('login');
    }

    return match (Auth::user()->role?->nama_role) {
        'admin' => redirect()->route('admin.pengguna.index'),
        'instansi' => redirect()->route('instansi.profile'),
        'unit_layanan' => redirect()->route('unit_layanan.profile'),
        default => redirect()->route('login'),
    };
})->name('home');

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
/*
|--------------------------------------------------------------------------
| Route Auth (frontend dulu, belum ada logic beneran)
|--------------------------------------------------------------------------
*/
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.submit');

/*
|--------------------------------------------------------------------------
| Route Auth Register
|--------------------------------------------------------------------------
*/

Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.submit');

Route::middleware('auth')->get('/pdf/sk/{sk}', [PdfController::class, 'sk'])->name('pdf.sk');
Route::middleware('auth')->get('/pdf/maklumat/{maklumat}', [PdfController::class, 'maklumat'])->name('pdf.maklumat');
