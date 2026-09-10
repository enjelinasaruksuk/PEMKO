<?php

use Illuminate\Support\Facades\Route;

Route::prefix('instansi')
    ->name('instansi.')
    ->group(function () {

        /*
        |--------------------------------------------------------------------------
        | Profile
        |--------------------------------------------------------------------------
        */
        Route::get('/profile', function () {
            $profile = null;
            return view('pages.instansi.profile.index', compact('profile'));
        })->name('profile');

        Route::put('/profile', function () {
            return redirect()->route('instansi.profile');
        })->name('profile.update');

        /*
        |--------------------------------------------------------------------------
        | Perda & Perwali
        |--------------------------------------------------------------------------
        */
        Route::get('/perda-perwali', function () {
            $perdaList   = collect();
            $perwaliList = collect();
            $namaUnit    = 'Sekretariat Daerah';

            return view('pages.instansi.perda_perwali.index', compact('perdaList', 'perwaliList', 'namaUnit'));
        })->name('perda_perwali.index');

        /*
        |--------------------------------------------------------------------------
        | Nama Unit Layanan (monitoring instansi level 2 di bawah SETDA)
        |--------------------------------------------------------------------------
        */
        Route::get('/unit-layanan', function () {
            $unitLayananList = collect([
                (object) ['id' => 1, 'nama' => 'Bagian Organisasi', 'username' => 'organisasi', 'status' => 'Aktif'],
                (object) ['id' => 2, 'nama' => 'Bagian Hukum',      'username' => 'hukum',      'status' => 'Aktif'],
                (object) ['id' => 3, 'nama' => 'Bagian Lembaga',    'username' => 'lembaga',    'status' => 'Aktif'],
                (object) ['id' => 4, 'nama' => 'Bagian Umum',       'username' => 'umum',       'status' => 'Aktif'],
            ]);

            return view('pages.instansi.unit_layanan.index', compact('unitLayananList'));
        })->name('unit_layanan.index');

        /*
        |--------------------------------------------------------------------------
        | Nama Pelayanan (milik SETDA sendiri)
        |--------------------------------------------------------------------------
        */
        Route::get('/pelayanan', function () {
            $pelayananList = collect();
            return view('pages.instansi.pelayanan.index', compact('pelayananList'));
        })->name('pelayanan.index');

        Route::get('/pelayanan/create', function () {
            return view('pages.instansi.pelayanan.create');
        })->name('pelayanan.create');

        Route::post('/pelayanan', function () {
            return redirect()->route('instansi.pelayanan.index');
        })->name('pelayanan.store');

        Route::get('/pelayanan/{id}/edit', function ($id) {
            $data = (object) ['id' => $id]; // dummy, nanti diganti Model asli
            return view('pages.instansi.pelayanan.edit', compact('data'));
        })->name('pelayanan.edit');

        Route::put('/pelayanan/{id}', function ($id) {
            return redirect()->route('instansi.pelayanan.index');
        })->name('pelayanan.update');

        Route::delete('/pelayanan/{id}', function ($id) {
            return redirect()->route('instansi.pelayanan.index');
        })->name('pelayanan.destroy');

        /*
        |--------------------------------------------------------------------------
        | Pelayanan SK — milik SETDA sendiri (CRUD penuh)
        |--------------------------------------------------------------------------
        */
        Route::get('/pengesahan-sk', function () {
            $skList = collect([
                (object) [
                    'id' => 1,
                    'nama_dinas' => 'Sekretariat Daerah',
                    'no_sk' => '000.8.3.2/958/436.3.2/2025',
                    'tanggal_sk' => '2025-12-04',
                    'status' => 'Aktif',
                    'jenis_sk' => 'SK Baru',
                    'no_sk_sebelumnya' => null,
                    'pengesahan' => 'Sudah disetujui',
                ],
                (object) [
                    'id' => 2,
                    'nama_dinas' => 'Sekretariat Daerah',
                    'no_sk' => '000.8.3.2/958/436.3.2/2025',
                    'tanggal_sk' => '2025-12-04',
                    'status' => 'Aktif',
                    'jenis_sk' => 'SK Baru',
                    'no_sk_sebelumnya' => null,
                    'pengesahan' => 'Belum disetujui',
                ],
            ]);

            return view('pages.instansi.sk.index', compact('skList'));
        })->name('sk.index');

        Route::post('/pengesahan-sk', fn() => redirect()->route('instansi.sk.index'))->name('sk.store');
        Route::put('/pengesahan-sk/{id}', fn($id) => redirect()->route('instansi.sk.index'))->name('sk.update');
        Route::delete('/pengesahan-sk/{id}', fn($id) => redirect()->route('instansi.sk.index'))->name('sk.destroy');
        Route::put('/pengesahan-sk/{id}/status', fn($id) => redirect()->route('instansi.sk.index'))->name('sk.status');

        /*
        |--------------------------------------------------------------------------
        | Pelayanan SK — monitoring unit di bawah SETDA (read only + approval)
        |--------------------------------------------------------------------------
        */
        Route::get('/pengesahan-sk/unit/{unit}', function ($unit) {
            $namaUnit = ucwords(str_replace('-', ' ', $unit));

            $skList = collect([
                (object) [
                    'id' => 1,
                    'nama_dinas' => 'Bagian Organisasi',
                    'no_sk' => '000.8.3.2/958/436.3.2/2025',
                    'tanggal_sk' => '2025-12-04',
                    'status' => 'Aktif',
                    'pengesahan' => 'Sudah disetujui',
                ],
                (object) [
                    'id' => 2,
                    'nama_dinas' => 'Bagian Hukum',
                    'no_sk' => '000.8.3.2/958/436.3.2/2025',
                    'tanggal_sk' => '2025-12-04',
                    'status' => 'Aktif',
                    'pengesahan' => 'Belum disetujui',
                ],
            ]);

            return view('pages.instansi.sk.show', compact('skList', 'namaUnit', 'unit'));
        })->name('pelayanan_sk.show');

        Route::put('/pengesahan-sk/unit/{unit}/{id}/approve', function ($unit, $id) {
            return redirect()->route('instansi.pelayanan_sk.show', $unit);
        })->name('sk.approve');

        /*
        |--------------------------------------------------------------------------
        | Maklumat (milik SETDA — bisa mengajukan "Ganti Pejabat")
        |--------------------------------------------------------------------------
        */
        Route::get('/maklumat', function () {
            $maklumatList = collect([
                (object) ['id' => 1, 'isi' => 'Kami siap memberikan pelayanan sesuai standar pelayanan, melakukan perbaikan secara terus menerus, dan apabila kami tidak memberikan pelayanan sesuai dengan standar pelayanan yang telah ditetapkan, kami siap menerima sanksi dan/atau memberikan kompensasi sesuai dengan peraturan perundang-undangan yang berlaku.', 'nama_penjebat' => 'Otok Kuswandaru', 'tanggal_input' => '2025-08-11', 'status' => 'disetujui'],
                (object) ['id' => 2, 'isi' => 'Kami siap memberikan pelayanan sesuai standar pelayanan, melakukan perbaikan secara terus menerus, dan apabila kami tidak memberikan pelayanan sesuai dengan standar pelayanan yang telah ditetapkan, kami siap menerima sanksi dan/atau memberikan kompensasi sesuai dengan peraturan perundang-undangan yang berlaku.', 'nama_penjebat' => 'Otok Kuswandaru', 'tanggal_input' => '2025-08-11', 'status' => 'pending'],
                (object) ['id' => 3, 'isi' => 'Kami siap memberikan pelayanan sesuai standar pelayanan, melakukan perbaikan secara terus menerus, dan apabila kami tidak memberikan pelayanan sesuai dengan standar pelayanan yang telah ditetapkan, kami siap menerima sanksi dan/atau memberikan kompensasi sesuai dengan peraturan perundang-undangan yang berlaku.', 'nama_penjebat' => 'Otok Kuswandaru', 'tanggal_input' => '2025-08-11', 'status' => 'disetujui'],
            ]);

            return view('pages.instansi.maklumat.index', compact('maklumatList'));
        })->name('maklumat.index');

        Route::post('/maklumat', fn() => redirect()->route('instansi.maklumat.index'))->name('maklumat.store');
    });
