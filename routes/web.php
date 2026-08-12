<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Route Testing / Stub - Admin
|--------------------------------------------------------------------------
*/
Route::get('/test', fn() => view('pages.test'))->name('dashboard');
Route::get('/pengguna', fn() => view('pages.test_admin'))->name('pengguna.index');
Route::get('/instansi', fn() => view('pages.test_admin'))->name('instansi.index');
Route::get('/sk', fn() => view('pages.test_admin'))->name('sk.index');

/*
|--------------------------------------------------------------------------
| Route Testing / Stub - Instansi
|--------------------------------------------------------------------------
*/
Route::get('/test-instansi', fn() => view('pages.instansi.test'));

/*
|--------------------------------------------------------------------------
| Route Testing / Stub - Unit Layanan
|--------------------------------------------------------------------------
*/
Route::get('/pelayanan', fn() => view('pages.test_pengguna'))->name('pelayanan.index');
Route::post('/logout', fn() => redirect('/test-admin'))->name('logout');

/*
|--------------------------------------------------------------------------
| Route Unit Layanan (beneran, sudah pakai folder)
|--------------------------------------------------------------------------
*/
Route::get('/profile', function () {
    $profile = null;
    return view('pages.unit_layanan.profile', compact('profile'));
})->name('profile');

Route::put('/profile', function () {
    return redirect()->route('profile');
})->name('profile.update');