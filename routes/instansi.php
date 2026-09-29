<?php

use App\Http\Controllers\Instansi\MaklumatController as InstansiMaklumatController;
use App\Http\Controllers\Instansi\OwnSkController;
use App\Http\Controllers\Instansi\PelayananController as InstansiPelayananController;
use App\Http\Controllers\Instansi\PeraturanController;
use App\Http\Controllers\Instansi\ProfileController as InstansiProfileController;
use App\Http\Controllers\Instansi\SkController as InstansiSkController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'role:instansi'])
    ->prefix('instansi')
    ->name('instansi.')
    ->group(function () {

        /*
        |--------------------------------------------------------------------------
        | Profile
        |--------------------------------------------------------------------------
        */
        Route::get('/profile', [InstansiProfileController::class, 'index'])->name('profile');

        Route::put('/profile', [InstansiProfileController::class, 'update'])
            ->name('profile.update');

        /*
        |--------------------------------------------------------------------------
        | Perda & Perwali (masih dummy)
        |--------------------------------------------------------------------------
        */
        Route::get('/perda-perwali', [InstansiProfileController::class, 'regulations'])
            ->name('perda_perwali.index');
        Route::post('/perda', [PeraturanController::class, 'storePerda'])->name('perda.store');
        Route::put('/perda/{perda}', [PeraturanController::class, 'updatePerda'])->name('perda.update');
        Route::delete('/perda/{perda}', [PeraturanController::class, 'destroyPerda'])->name('perda.destroy');
        Route::post('/perwali', [PeraturanController::class, 'storePerwali'])->name('perwali.store');
        Route::put('/perwali/{perwali}', [PeraturanController::class, 'updatePerwali'])->name('perwali.update');
        Route::delete('/perwali/{perwali}', [PeraturanController::class, 'destroyPerwali'])->name('perwali.destroy');

        /*
        |--------------------------------------------------------------------------
        | Nama Unit Layanan (masih dummy)
        |--------------------------------------------------------------------------
        */
        Route::get('/unit-layanan', [InstansiProfileController::class, 'unitLayanan'])
            ->name('unit_layanan.index');

        /*
        |--------------------------------------------------------------------------
        | Nama Pelayanan (database)
        |--------------------------------------------------------------------------
        */
        Route::get('/pelayanan', [InstansiPelayananController::class, 'index'])->name('pelayanan.index');
        Route::get('/pelayanan/create', [InstansiPelayananController::class, 'create'])->name('pelayanan.create');
        Route::post('/pelayanan', [InstansiPelayananController::class, 'store'])->name('pelayanan.store');
        Route::get('/pelayanan/{pelayanan}', [InstansiPelayananController::class, 'show'])->name('pelayanan.show');
        Route::get('/pelayanan/{pelayanan}/edit', [InstansiPelayananController::class, 'edit'])->name('pelayanan.edit');
        Route::put('/pelayanan/{pelayanan}', [InstansiPelayananController::class, 'update'])->name('pelayanan.update');
        Route::delete('/pelayanan/{pelayanan}', [InstansiPelayananController::class, 'destroy'])->name('pelayanan.destroy');

        Route::get('/pengesahan-sk', [InstansiSkController::class, 'index'])->name('sk.index');
        Route::get('/pengesahan-sk/milik-instansi', [OwnSkController::class, 'index'])->name('own_sk.index');
        Route::post('/pengesahan-sk/milik-instansi', [OwnSkController::class, 'store'])->name('own_sk.store');
        Route::put('/pengesahan-sk/milik-instansi/{sk}', [OwnSkController::class, 'update'])->name('own_sk.update');
        Route::delete('/pengesahan-sk/milik-instansi/{sk}', [OwnSkController::class, 'destroy'])->name('own_sk.destroy');
        Route::post('/pengesahan-sk/milik-instansi/{sk}/kirim', [OwnSkController::class, 'submit'])->name('own_sk.submit');
        Route::get('/pengesahan-sk/milik-instansi/{sk}/layanan', [OwnSkController::class, 'layanan'])->name('own_sk.layanan');
        Route::post('/pengesahan-sk/milik-instansi/{sk}/layanan/{pelayanan}', [OwnSkController::class, 'attachLayanan'])->name('own_sk.layanan.attach');
        Route::delete('/pengesahan-sk/milik-instansi/{sk}/layanan/{pelayanan}', [OwnSkController::class, 'detachLayanan'])->name('own_sk.layanan.detach');
        Route::delete('/pengesahan-sk/milik-instansi/{sk}/layanan/{pelayanan}/hapus', [OwnSkController::class, 'destroyLayanan'])->name('own_sk.layanan.destroy');
        Route::put('/pengesahan-sk/milik-instansi/{sk}/approve', [InstansiSkController::class, 'approveOwned'])->name('own_sk.approve');

        /*
        |--------------------------------------------------------------------------
        | Pelayanan SK — monitoring unit di bawah SETDA (database + approval)
        |--------------------------------------------------------------------------
        */
        Route::get('/pengesahan-sk/unit/{unit}', [InstansiSkController::class, 'show'])
            ->name('pelayanan_sk.show');

        Route::put('/pengesahan-sk/unit/{unit}/{sk}/approve', [InstansiSkController::class, 'approve'])
            ->name('sk.approve');

        /*
        |--------------------------------------------------------------------------
        | Maklumat (database + approval)
        |--------------------------------------------------------------------------
        */
        Route::get('/maklumat', [InstansiMaklumatController::class, 'index'])->name('maklumat.index');
        Route::post('/maklumat', [InstansiMaklumatController::class, 'store'])->name('maklumat.store');
    });
