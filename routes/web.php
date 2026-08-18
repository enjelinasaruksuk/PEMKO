<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Route Testing / Stub - Admin
|--------------------------------------------------------------------------
*/
Route::get('/test', fn() => view('pages.admin.test'))->name('dashboard');
/*
|--------------------------------------------------------------------------
| Route Manajemen SK - Admin
|--------------------------------------------------------------------------
*/
Route::get('/sk', function () {
    $skList = collect([
        (object)[
            'id' => 1,
            'nama_dinas' => 'Sekretariat Daerah',
            'no_sk' => '000.8.3.2/958/436.3.2/2025',
            'tanggal_sk' => '04 Desember 2025',
            'status' => 'Aktif',
            'sudah_diajukan' => true,
            'konfirmasi_status' => 'disetujui',
            'catatan' => '',
        ],
        (object)[
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

    return view('pages.admin.sk.index', compact('skList'));
})->name('sk.index');

Route::put('/sk/{id}/konfirmasi', fn($id) => redirect()->route('sk.index'))->name('sk.confirm');
Route::delete('/sk/{id}', fn($id) => redirect()->route('sk.index'))->name('sk.destroy');

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
/*
|--------------------------------------------------------------------------
| Route Manajemen Pelayanan (Komponen) - Admin
|--------------------------------------------------------------------------
*/
Route::get('/admin/pelayanan', function () {
    $komponenList = collect([
        (object)['id' => 1, 'nama_komponen' => 'Persyaratan', 'kategori' => 'Penyampaian'],
        (object)['id' => 2, 'nama_komponen' => 'Biaya', 'kategori' => 'Penyampaian'],
        (object)['id' => 3, 'nama_komponen' => 'Evaluasi Kinerja Pelaksana', 'kategori' => 'Pengelolaan'],
    ]);
    return view('pages.admin.pelayanan.index', compact('komponenList'));
})->name('admin.pelayanan.index');

Route::post('/admin/pelayanan', fn() => redirect()->route('admin.pelayanan.index'))->name('admin.pelayanan.store');
Route::put('/admin/pelayanan/{id}', fn($id) => redirect()->route('admin.pelayanan.index'))->name('admin.pelayanan.update');
Route::delete('/admin/pelayanan/{id}', fn($id) => redirect()->route('admin.pelayanan.index'))->name('admin.pelayanan.destroy');


Route::post('/pelayanan', fn() => redirect()->route('pelayanan.index'))->name('pelayanan.store');
Route::put('/pelayanan/{id}', fn($id) => redirect()->route('pelayanan.index'))->name('pelayanan.update');
Route::delete('/pelayanan/{id}', fn($id) => redirect()->route('pelayanan.index'))->name('pelayanan.destroy');
Route::post('/logout', fn() => redirect('/test-admin'))->name('logout');

/*
|--------------------------------------------------------------------------
| Route Profile (dipakai instansi & unit layanan)
|--------------------------------------------------------------------------
*/
Route::get('/profile', function () {
    $profile = null;
    $role = 'unit_layanan'; // ganti ke 'instansi' buat testing sidebar instansi

    return match ($role) {
        'instansi' => view('pages.instansi.profile', compact('profile')),
        'unit_layanan' => view('pages.unit_layanan.profile', compact('profile')),
    };
})->name('profile');

Route::put('/profile', function () {
    return redirect()->route('profile');
})->name('profile.update');

/*
|--------------------------------------------------------------------------
| Route Perda & Perwali (dipakai instansi & unit layanan)
|--------------------------------------------------------------------------
*/
Route::get('/perda-perwali', function () {
    $perdaList = collect();
    $perwaliList = collect();
    $namaUnit = 'Sekretariat Daerah';
    $role = 'unit_layanan'; // samain sama role di route profile

    return match ($role) {
        'instansi' => view('pages.instansi.perda_perwali', compact('perdaList', 'perwaliList', 'namaUnit')),
        'unit_layanan' => view('pages.unit_layanan.perda_perwali', compact('perdaList', 'perwaliList', 'namaUnit')),
    };
})->name('perda_perwali.index');

Route::post('/perda', fn() => redirect()->route('perda_perwali.index'))->name('perda.store');
Route::put('/perda/{id}', fn($id) => redirect()->route('perda_perwali.index'))->name('perda.update');
Route::delete('/perda/{id}', fn($id) => redirect()->route('perda_perwali.index'))->name('perda.destroy');

Route::post('/perwali', fn() => redirect()->route('perda_perwali.index'))->name('perwali.store');
Route::put('/perwali/{id}', fn($id) => redirect()->route('perda_perwali.index'))->name('perwali.update');
Route::delete('/perwali/{id}', fn($id) => redirect()->route('perda_perwali.index'))->name('perwali.destroy');

/*
|--------------------------------------------------------------------------
| Route Manajemen Akun - Admin
|--------------------------------------------------------------------------
*/
Route::get('/pengguna', function () {
    $penggunaList = collect([
        (object)[
            'id' => 1,
            'nama' => 'Admin Badan Kesatuan Bangka dan Politik',
            'email' => 'kesbangpol@batam.g.id',
            'instansi_nama' => 'Pemerintah kota batam',
            'instansi_singkatan' => 'BADAN KESATUAN BANGSA DAN POLITIK',
            'peran' => 'Instansi Level 1',
            'status' => 'Aktif',
            'masuk_terakhir' => '6 Agustus',
        ],
        (object)[
            'id' => 2,
            'nama' => 'Admin Badan Pendapatan Daerah',
            'email' => 'ilapenda@batam.go.id',
            'instansi_nama' => 'Pemerintah kota batam',
            'instansi_singkatan' => 'BADAN PENDAPATAN DAERAH',
            'peran' => 'Instansi Level 1',
            'status' => 'Aktif',
            'masuk_terakhir' => '17 Agustus',
        ],
        (object)[
            'id' => 3,
            'nama' => 'Admin Badan Pengelolaan Keuangan dan Aset Daerah',
            'email' => 'bpkad@batam.go.ig',
            'instansi_nama' => 'Pemerintah Kota Batam',
            'instansi_singkatan' => 'BADAN PENGELOLAAN KEUANGAN DAN ASET DAERAH',
            'peran' => 'Instansi Level 1',
            'status' => 'Aktif',
            'masuk_terakhir' => '10 Agustus',
        ],
    ]);

    return view('pages.admin.pengguna.index', compact('penggunaList'));
})->name('pengguna.index');

Route::delete('/pengguna/{id}', fn($id) => redirect()->route('pengguna.index'))->name('pengguna.destroy');

/*
|--------------------------------------------------------------------------
| Route Manajemen Instansi - Admin
|--------------------------------------------------------------------------
*/
Route::get('/instansi', function () {
    $instansiList = collect([
        (object)['id' => 1, 'nama' => 'Bagian Organisasi', 'email' => 'organisasi@batam.go.id'],
        (object)['id' => 2, 'nama' => 'Bagian Hukum', 'email' => 'hukum@batam.go.id'],
        (object)['id' => 3, 'nama' => 'Bagian Lembaga', 'email' => 'lembaga@batam.go.id'],
        (object)['id' => 4, 'nama' => 'Bagian Umum', 'email' => 'umum@batam.go.id'],
    ]);

    $instansiLevel1 = collect([
        (object)['id' => 1, 'nama' => 'Sekretariat Daerah'],
        (object)['id' => 2, 'nama' => 'Dinas Pendidikan'],
    ]);

    $instansiLevel2 = collect([
        (object)['id' => 1, 'nama' => 'Bagian Organisasi'],
        (object)['id' => 2, 'nama' => 'Bagian Hukum'],
    ]);

    return view('pages.admin.instansi.index', compact('instansiList', 'instansiLevel1', 'instansiLevel2'));
})->name('instansi.index');

Route::post('/instansi', fn() => redirect()->route('instansi.index'))->name('instansi.store');
Route::put('/instansi/{id}', fn($id) => redirect()->route('instansi.index'))->name('instansi.update');
Route::delete('/instansi/{id}', fn($id) => redirect()->route('instansi.index'))->name('instansi.destroy');