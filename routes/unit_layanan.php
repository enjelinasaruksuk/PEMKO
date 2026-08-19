<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UnitLayanan\ProfileController;
use App\Http\Controllers\UnitLayanan\PelayananController;
use App\Http\Controllers\UnitLayanan\SkController;

/*
|--------------------------------------------------------------------------
| Unit Layanan Routes
|--------------------------------------------------------------------------
*/

Route::prefix('unit-layanan')
    ->name('unit_layanan.')
    ->group(function () {

        /*
        |--------------------------------------------------------------------------
        | Profile
        |--------------------------------------------------------------------------
        */

        Route::get('/profile', [
            ProfileController::class,
            'index'
        ])->name('profile');

        Route::put('/profile', [
            ProfileController::class,
            'update'
        ])->name('profile.update');

        Route::get('/profile/regulations', [
            ProfileController::class,
            'regulations'
        ])->name('profile.regulations');


        /*
        |--------------------------------------------------------------------------
        | Nama Pelayanan
        |--------------------------------------------------------------------------
        */

        Route::get('/pelayanan', [
            PelayananController::class,
            'index'
        ])->name('pelayanan.index');

        Route::get('/pelayanan/create', [
            PelayananController::class,
            'create'
        ])->name('pelayanan.create');

        Route::post('/pelayanan', [
            PelayananController::class,
            'store'
        ])->name('pelayanan.store');

        Route::get('/pelayanan/{pelayanan}/edit', [
            PelayananController::class,
            'edit'
        ])->name('pelayanan.edit');

        Route::put('/pelayanan/{pelayanan}', [
            PelayananController::class,
            'update'
        ])->name('pelayanan.update');

        Route::delete('/pelayanan/{pelayanan}', [
            PelayananController::class,
            'destroy'
        ])->name('pelayanan.destroy');


        /*
        |--------------------------------------------------------------------------
        | Pengesahan SK
        |--------------------------------------------------------------------------
        */

        Route::get('/pengesahan-sk', [
            SkController::class,
            'index'
        ])->name('sk.index');

        Route::get('/pengesahan-sk/create', [
            SkController::class,
            'create'
        ])->name('sk.create');

        Route::post('/pengesahan-sk', [
            SkController::class,
            'store'
        ])->name('sk.store');

        Route::get('/pengesahan-sk/{sk}/edit', [
            SkController::class,
            'edit'
        ])->name('sk.edit');

        Route::put('/pengesahan-sk/{sk}', [
            SkController::class,
            'update'
        ])->name('sk.update');

        Route::delete('/pengesahan-sk/{sk}', [
            SkController::class,
            'destroy'
        ])->name('sk.destroy');

        Route::patch('/pengesahan-sk/{sk}/status', [
            SkController::class,
            'updateStatus'
        ])->name('sk.status');
    });