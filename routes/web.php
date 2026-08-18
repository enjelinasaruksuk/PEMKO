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

Route::post('/logout', fn() => redirect('/test-admin'))->name('logout');

/*
|--------------------------------------------------------------------------
| Route Unit Layanan - Profile
|--------------------------------------------------------------------------
| DATA DUMMY - belum nyambung ke database. Ini cuma supaya tampilan
| kelihatan "sudah terisi" sesuai desain. Ganti $profile = null untuk
| lihat tampilan empty-state (kotak kosong + tombol "Tambah Data").
|
| TODO backend: ganti dengan data asli, contoh:
|   $profile = auth()->user()->instansi->profile()->with(['perdas', 'perwalis'])->first();
*/
Route::get('/profile', function () {
    $profile = (object) [
        'nama_unit'     => 'Bagian Organisasi',
        'nama_kepala'   => 'Drs. Ahmad Fauzi, M.Si',
        'status_kepala' => 'non_plt',
        'website'       => 'organisasi.batam.go.id',
        'alamat'        => 'Jl. Engku Putri No. 1, Batam Center',
        'nip'           => '19750101 200003 1 001',
        'pangkat'       => 'Pembina Utama Muda (IV/c)',
        'misi'          => 'Mewujudkan tata kelola pemerintahan yang baik',
        'email'         => 'organisasi@batam.go.id',
        'telepon'       => '(0778) 123456',
        'faksimile'     => '(0778) 123457',
        'motto'         => 'Melayani Dengan Hati',
        'visi'          => 'Terwujudnya Organisasi Perangkat Daerah yang Efektif dan Efisien',
        'perdas'        => [
            (object) ['id' => 1, 'isi' => 'Peraturan Daerah Kota Batam Nomor 6 Tahun 2023 tentang Pembentukan Dan Susunan Perangkat Daerah'],
        ],
        'perwalis'      => [
            (object) ['id' => 1, 'isi' => 'Peraturan Walikota (Perwali) Kota Batam Nomor 67 Tahun 2022 tentang Perubahan Atas Peraturan Wali Kota Batam No.77 Tahun 2021 Tentang Susunan Organisasi dan Tata Kerja Sekretariat Daerah, Inspektorat Daerah, Sekretariat Dewan Perwakilan Rakyat Daerah, Badan Daerah dan Kecamatan'],
        ],
    ];

    // Mau lihat tampilan kosong (belum ada data)? Un-comment baris di bawah:
    // $profile = null;

    return view('pages.unit_layanan.profile', compact('profile'));
})->name('profile');

Route::put('/profile', function () {
    return redirect()->route('profile');
})->name('profile.update');

/*
|--------------------------------------------------------------------------
| Route Unit Layanan - Nama Pelayanan
|--------------------------------------------------------------------------
| TODO backend: pindahkan ke Route::resource('pelayanan', PelayananController::class)
*/
Route::prefix('pelayanan')->name('pelayanan.')->group(function () {
    Route::get('/', function () {
        $profile = (object) ['nama_unit' => 'Bagian Organisasi'];
        $layanans = [
            (object) ['id' => 1, 'nama' => 'Layanan Konsultasi dan Koordinasi Terkait Kelembagaan, Analisis Jabatan, Pelayanan Publik, Tata Laksana, Perencanaan, Pelaporan Kinerja, dan Reformasi Birokrasi'],
            (object) ['id' => 2, 'nama' => 'Layanan Konsultasi, Koordinasi, dan Asistensi Terkait Kelembagaan dan Analisis Jabatan'],
            (object) ['id' => 3, 'nama' => 'Layanan Konsultasi, Koordinasi, dan Asistensi Terkait Pelayanan Publik dan Tata Laksana'],
        ];
        return view('pages.unit_layanan.pelayanan.index', compact('profile', 'layanans'));
    })->name('index');

    Route::get('/create', function () {
        $profile = (object) ['nama_unit' => 'Bagian Organisasi'];
        return view('pages.unit_layanan.pelayanan.form', compact('profile'));
    })->name('create');

    Route::post('/', fn() => redirect()->route('pelayanan.index'))->name('store');

    Route::get('/{layanan}/edit', function ($layanan) {
        $profile = (object) ['nama_unit' => 'Bagian Organisasi'];
        return view('pages.unit_layanan.pelayanan.form', compact('profile', 'layanan'));
    })->name('edit');

    Route::put('/{layanan}', fn($layanan) => redirect()->route('pelayanan.index'))->name('update');
    Route::delete('/{layanan}', fn($layanan) => redirect()->route('pelayanan.index'))->name('destroy');
});

/*
|--------------------------------------------------------------------------
| Route Unit Layanan - Pengajuan SK
|--------------------------------------------------------------------------
| TODO backend: pindahkan ke Route::resource('pengajuan-sk', PengajuanSkController::class)
*/
Route::prefix('pengajuan-sk')->name('pengajuan_sk.')->group(function () {
    Route::get('/', function () {
        $sks = [
            (object) ['id' => 1, 'no_sk' => '000.8.3.2/958/436.3.2/2025', 'tanggal_sk' => '04 Desember 2025', 'jenis_sk' => 'sk_baru', 'status_pengesahan' => 'disetujui'],
            (object) ['id' => 2, 'no_sk' => '000.8.3.2/958/436.3.2/2025', 'tanggal_sk' => '04 Desember 2025', 'jenis_sk' => 'menggantikan', 'no_sk_sebelumnya' => '003/2026', 'status_pengesahan' => 'menunggu'],
        ];
        return view('pages.unit_layanan.pengajuan_sk.index', compact('sks'));
    })->name('index');

    Route::post('/', fn() => redirect()->route('pengajuan_sk.index'))->name('store');
    Route::put('/{sk}', fn($sk) => redirect()->route('pengajuan_sk.index'))->name('update');
    Route::delete('/{sk}', fn($sk) => redirect()->route('pengajuan_sk.index'))->name('destroy');
});

/*
|--------------------------------------------------------------------------
| Route Unit Layanan - Perda & Perwali (dipakai di modal halaman Profile)
|--------------------------------------------------------------------------
| TODO backend: pindahkan ke PerdaController / PerwaliController
*/
Route::post('/perda', fn() => redirect()->route('profile'))->name('perda.store');
Route::put('/perda/{perda}', fn($perda) => redirect()->route('profile'))->name('perda.update');
Route::delete('/perda/{perda}', fn($perda) => redirect()->route('profile'))->name('perda.destroy');

Route::post('/perwali', fn() => redirect()->route('profile'))->name('perwali.store');
Route::put('/perwali/{perwali}', fn($perwali) => redirect()->route('profile'))->name('perwali.update');
Route::delete('/perwali/{perwali}', fn($perwali) => redirect()->route('profile'))->name('perwali.destroy');