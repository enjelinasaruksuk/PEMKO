<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

require __DIR__ . '/admin.php';
require __DIR__ . '/instansi.php';
require __DIR__ . '/unit_layanan.php';


Route::post('/logout', function () {
    Auth::logout();

    request()->session()->invalidate();
    request()->session()->regenerateToken();

    return redirect('/login');
})->name('logout');

/*
|--------------------------------------------------------------------------
| Route Auth (frontend dulu, belum ada logic beneran)
|--------------------------------------------------------------------------
*/
Route::get('/login', function () {
    return view('auth.login');
})->name('login');

Route::post('/login', function () {
    return redirect()->route('login');
})->name('login.submit');

/*
|--------------------------------------------------------------------------
| Route Auth Register
|--------------------------------------------------------------------------
*/

Route::get('/register', function () {

    $instansiLevel1 = collect([
        (object) ['id' => 1, 'nama' => 'Sekretariat Daerah'],
        (object) ['id' => 2, 'nama' => 'Dinas Pendidikan'],
    ]);

    $instansiLevel2 = collect([
        (object) ['id' => 1, 'nama' => 'Bagian Organisasi'],
        (object) ['id' => 2, 'nama' => 'Bagian Hukum'],
    ]);

    return view('auth.register', compact('instansiLevel1', 'instansiLevel2'));
})->name('register');

Route::post('/register', function () {
    return redirect()->route('login');
})->name('register.submit');