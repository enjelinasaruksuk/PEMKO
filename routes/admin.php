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
Route::get('/instansi-pengajuan', function () {

    $pengajuanList = collect([
        (object) [
            'id' => 1,
            'instansi_level_1' => 'Sekretariat Daerah',
            'instansi_level_2' => 'Bagian Organisasi',
            'email' => 'organisasi@batam.go.id',
            'status' => 'pending',
        ],
        (object) [
            'id' => 2,
            'instansi_level_1' => 'Badan Pendapatan Daerah',
            'instansi_level_2' => null,
            'email' => 'bapenda@batam.go.id',
            'status' => 'disetujui',
        ],
        (object) [
            'id' => 3,
            'instansi_level_1' => 'Bagian Lembaga',
            'instansi_level_2' => null,
            'email' => 'lembaga@batam.go.id',
            'status' => 'ditolak',
        ],
    ]);

    return view('pages.admin.instansi_pengajuan.index', compact('pengajuanList'));
})->name('instansi_pengajuan.index');

Route::put('/instansi-pengajuan/{id}', function ($id) {
    return redirect()->route('admin.instansi_pengajuan.index');
})->name('instansi_pengajuan.update');

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

    