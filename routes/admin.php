<?php

use App\Http\Controllers\Admin\InstansiPengajuanController;
use App\Http\Controllers\Admin\PenggunaController;
use App\Http\Controllers\Admin\SkController as AdminSkController;
use App\Http\Controllers\PdfController;
use Illuminate\Support\Facades\Route;

Route::prefix('admin')
    ->name('admin.')
    ->middleware(['auth', 'role:admin'])
    ->group(function () {

        /*
        |--------------------------------------------------------------------------
        | Manajemen Pelayanan
        |--------------------------------------------------------------------------
        */

        Route::get('/pelayanan', function () {
            $komponenList = collect([
                (object) [
                    'id' => 1,
                    'nama_komponen' => 'Persyaratan',
                    'kategori' => 'Penyampaian',
                ],
                (object) [
                    'id' => 2,
                    'nama_komponen' => 'Biaya',
                    'kategori' => 'Penyampaian',
                ],
                (object) [
                    'id' => 3,
                    'nama_komponen' => 'Evaluasi Kinerja Pelaksana',
                    'kategori' => 'Pengelolaan',
                ],
            ]);

            return view(
                'pages.admin.pelayanan.index',
                compact('komponenList')
            );
        })->name('pelayanan.index');

        Route::post('/pelayanan', function () {
            return redirect()->route('admin.pelayanan.index');
        })->name('pelayanan.store');

        Route::put('/pelayanan/{id}', function ($id) {
            return redirect()->route('admin.pelayanan.index');
        })->name('pelayanan.update');

        Route::delete('/pelayanan/{id}', function ($id) {
            return redirect()->route('admin.pelayanan.index');
        })->name('pelayanan.destroy');

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

        Route::delete('/pengguna/{id}', function ($id) {
            return redirect()->route('admin.pengguna.index');
        })->name('pengguna.destroy');

        Route::put('/pengguna/{id}/toggle-status', function ($id) {
            return redirect()->route('admin.pengguna.index');
        })->name('pengguna.toggle_status');

        /*
        |--------------------------------------------------------------------------
        | Manajemen Instansi
        |--------------------------------------------------------------------------
        */

        Route::get('/instansi', function () {

            $instansiList = collect([
                (object) [
                    'id' => 1,
                    'nama' => 'Bagian Organisasi',
                    'email' => 'organisasi@batam.go.id',
                    'level_akun' => 2,
                ],
                (object) [
                    'id' => 2,
                    'nama' => 'Bagian Hukum',
                    'email' => 'hukum@batam.go.id',
                    'level_akun' => 2,
                ],
                (object) [
                    'id' => 3,
                    'nama' => 'Bagian Lembaga',
                    'email' => 'lembaga@batam.go.id',
                    'level_akun' => 2,
                ],
                (object) [
                    'id' => 4,
                    'nama' => 'Bagian Umum',
                    'email' => 'umum@batam.go.id',
                    'level_akun' => 2,
                ],
            ]);

            $instansiLevel1 = collect([
                (object) [
                    'id' => 1,
                    'nama' => 'Sekretariat Daerah',
                ],
                (object) [
                    'id' => 2,
                    'nama' => 'Dinas Pendidikan',
                ],
            ]);

            $instansiLevel2 = collect([
                (object) [
                    'id' => 1,
                    'nama' => 'Bagian Organisasi',
                ],
                (object) [
                    'id' => 2,
                    'nama' => 'Bagian Hukum',
                ],
            ]);

            return view(
                'pages.admin.instansi.index',
                compact(
                    'instansiList',
                    'instansiLevel1',
                    'instansiLevel2'
                )
            );
        })->name('instansi.index');

        Route::post('/instansi', function () {
            return redirect()->route('admin.instansi.index');
        })->name('instansi.store');

        Route::put('/instansi/{id}', function ($id) {
            return redirect()->route('admin.instansi.index');
        })->name('instansi.update');

        Route::delete('/instansi/{id}', function ($id) {
            return redirect()->route('admin.instansi.index');
        })->name('instansi.destroy');

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
        Route::get('/maklumat', function () {

            $maklumatList = collect([
                (object) [
                    'id' => 1,
                    'isi' => 'Kami siap memberikan pelayanan sesuai dengan standar pelayanan, melakukan perbaikan secara terus menerus, dan apabila kami tidak memberikan pelayanan sesuai dengan standar pelayanan yang telah ditetapkan, kami siap menerima sanksi dan/atau memberikan kompensasi sesuai dengan peraturan perundang-undangan yang berlaku.',
                    'nama_penjebat' => 'Otok Kuswandaru',
                    'tanggal_input' => '11 Agustus 2025',
                    'status' => 'pending',
                ],
            ]);

            return view('pages.admin.maklumat.index', compact('maklumatList'));
        })->name('maklumat.index');

        Route::put('/maklumat/{id}', function ($id) {
            return redirect()->route('admin.maklumat.index');
        })->name('maklumat.update');
    });
