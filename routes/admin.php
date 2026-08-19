<?php

use Illuminate\Support\Facades\Route;

Route::prefix('admin')
    ->name('admin.')
    ->group(function () {

        /*
        |--------------------------------------------------------------------------
        | Dashboard
        |--------------------------------------------------------------------------
        */

        Route::get('/dashboard', function () {
            return view('pages.admin.dashboard.index');
        })->name('dashboard');


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

        Route::get('/sk', function () {

            $skList = collect([
                (object) [
                    'id' => 1,
                    'nama_dinas' => 'Sekretariat Daerah',
                    'no_sk' => '000.8.3.2/958/436.3.2/2025',
                    'tanggal_sk' => '04 Desember 2025',
                    'status' => 'Aktif',
                    'sudah_diajukan' => true,
                    'konfirmasi_status' => 'disetujui',
                    'catatan' => '',
                ],
                (object) [
                    'id' => 2,
                    'nama_dinas' => 'Sekretariat Daerah',
                    'no_sk' => '000.8.3.2/958/436.3.2/2025',
                    'tanggal_sk' => '04 Desember 2025',
                    'status' => 'Aktif',
                    'sudah_diajukan' => true,
                    'konfirmasi_status' => 'belum',
                    'catatan' => '',
                ],
            ]);

            return view(
                'pages.admin.sk.index',
                compact('skList')
            );
        })->name('sk.index');

        Route::put('/sk/{id}/konfirmasi', function ($id) {
            return redirect()->route('admin.sk.index');
        })->name('sk.confirm');

        Route::delete('/sk/{id}', function ($id) {
            return redirect()->route('admin.sk.index');
        })->name('sk.destroy');


        /*
        |--------------------------------------------------------------------------
        | Manajemen Pengguna
        |--------------------------------------------------------------------------
        */

        Route::get('/pengguna', function () {

            $penggunaList = collect([
                (object) [
                    'id' => 1,
                    'nama' => 'Admin Badan Kesatuan Bangsa dan Politik',
                    'email' => 'kesbangpol@batam.go.id',
                    'instansi_nama' => 'Pemerintah Kota Batam',
                    'instansi_singkatan' => 'BADAN KESATUAN BANGSA DAN POLITIK',
                    'peran' => 'Instansi Level 1',
                    'status' => 'Aktif',
                    'masuk_terakhir' => '6 Agustus',
                ],
                (object) [
                    'id' => 2,
                    'nama' => 'Admin Badan Pendapatan Daerah',
                    'email' => 'bapenda@batam.go.id',
                    'instansi_nama' => 'Pemerintah Kota Batam',
                    'instansi_singkatan' => 'BADAN PENDAPATAN DAERAH',
                    'peran' => 'Instansi Level 1',
                    'status' => 'Aktif',
                    'masuk_terakhir' => '17 Agustus',
                ],
            ]);

            return view(
                'pages.admin.pengguna.index',
                compact('penggunaList')
            );
        })->name('pengguna.index');

        Route::delete('/pengguna/{id}', function ($id) {
            return redirect()->route('admin.pengguna.index');
        })->name('pengguna.destroy');


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
                ],
                (object) [
                    'id' => 2,
                    'nama' => 'Bagian Hukum',
                    'email' => 'hukum@batam.go.id',
                ],
                (object) [
                    'id' => 3,
                    'nama' => 'Bagian Lembaga',
                    'email' => 'lembaga@batam.go.id',
                ],
                (object) [
                    'id' => 4,
                    'nama' => 'Bagian Umum',
                    'email' => 'umum@batam.go.id',
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
    });