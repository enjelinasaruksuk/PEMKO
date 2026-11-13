<?php

use App\Http\Controllers\Admin\InstansiPengajuanController;
use App\Http\Controllers\Admin\PenggunaController;
use App\Http\Controllers\Admin\SkController as AdminSkController;
use App\Http\Controllers\PdfController;
use App\Http\Controllers\Admin\PelayananController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\MaklumatController as AdminMaklumatController;
use App\Http\Controllers\Admin\TandaTanganController;
use App\Http\Controllers\Admin\InstansiController;

Route::prefix('admin')
    ->name('admin.')
    ->middleware(['auth', 'role:admin', 'no-cache'])
    ->group(function () {

        /*
        |--------------------------------------------------------------------------
        | Manajemen Pelayanan
        |--------------------------------------------------------------------------
        */

        Route::get('/pelayanan', [PelayananController::class, 'index'])->name('pelayanan.index');
        Route::post('/pelayanan', [PelayananController::class, 'store'])->name('pelayanan.store');
        Route::put('/pelayanan/{id}', [PelayananController::class, 'update'])->name('pelayanan.update');
        Route::delete('/pelayanan/{id}', [PelayananController::class, 'destroy'])->name('pelayanan.destroy');

        /*
        |--------------------------------------------------------------------------
        | Manajemen SK
        |--------------------------------------------------------------------------
        */

        Route::get('/sk', [AdminSkController::class, 'index'])->name('sk.index');
        Route::get('/sk/{sk}', [AdminSkController::class, 'show'])->name('sk.show');
        Route::get('/sk/{sk}/preview', [PdfController::class, 'previewSk'])->name('sk.preview');
        Route::put('/sk/{sk}/teruskan', [AdminSkController::class, 'forward'])->name('sk.forward');
        Route::put('/sk/{sk}/kembalikan', [AdminSkController::class, 'returnToOwner'])->name('sk.return');

        /*
        |--------------------------------------------------------------------------
        | Manajemen Pengguna
        |--------------------------------------------------------------------------
        */

        Route::get('/pengguna', [PenggunaController::class, 'index'])
            ->name('pengguna.index');
        Route::post('/pengguna/{pengguna}/reset-password', [PenggunaController::class, 'resetPassword'])
            ->name('pengguna.reset_password');

        Route::put('/pengguna/{pengguna}', [PenggunaController::class, 'update'])->name('pengguna.update');
        Route::put('/pengguna/{pengguna}/toggle-status', [PenggunaController::class, 'toggleStatus'])->name('pengguna.toggle_status');
        Route::delete('/pengguna/{pengguna}', [PenggunaController::class, 'destroy'])->name('pengguna.destroy');

                /*
        |--------------------------------------------------------------------------
        | Manajemen Instansi
        |--------------------------------------------------------------------------
        */
        Route::get('/instansi', [InstansiController::class, 'index'])->name('instansi.index');
        Route::post('/instansi', [InstansiController::class, 'store'])->name('instansi.store');
        Route::put('/instansi/{instansi}', [InstansiController::class, 'update'])->name('instansi.update');
        Route::delete('/instansi/{instansi}', [InstansiController::class, 'destroy'])->name('instansi.destroy');

        /*
        |--------------------------------------------------------------------------
        | Pengajuan Akun Instansi
        |--------------------------------------------------------------------------
        */
        Route::get('/instansi-pengajuan', [InstansiPengajuanController::class, 'index'])->name('instansi_pengajuan.index');
        Route::put('/instansi-pengajuan/{id}', [InstansiPengajuanController::class, 'update'])->name('instansi_pengajuan.update');

        /*
        |--------------------------------------------------------------------------
        | Maklumat
        |--------------------------------------------------------------------------
        */
        Route::get('/maklumat', [AdminMaklumatController::class, 'index'])->name('maklumat.index');
        Route::put('/maklumat/{maklumat}', [AdminMaklumatController::class, 'update'])->name('maklumat.update');

                /*
        |--------------------------------------------------------------------------
        | Spesimen Tanda Tangan
        |--------------------------------------------------------------------------
        */
        Route::get('/tanda-tangan', [TandaTanganController::class, 'index'])->name('tanda_tangan.index');
        Route::post('/tanda-tangan', [TandaTanganController::class, 'store'])->name('tanda_tangan.store');
        Route::get('/tanda-tangan/{tandaTangan}/gambar', [TandaTanganController::class, 'show'])->name('tanda_tangan.show');
        Route::delete('/tanda-tangan/{tandaTangan}', [TandaTanganController::class, 'destroy'])->name('tanda_tangan.destroy');
    });

