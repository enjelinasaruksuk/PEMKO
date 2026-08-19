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

            return view(
                'pages.instansi.profile.index',
                compact('profile')
            );
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

            $perdaList = collect();
            $perwaliList = collect();
            $namaUnit = 'Sekretariat Daerah';

            return view(
                'pages.instansi.perda-perwali.index',
                compact(
                    'perdaList',
                    'perwaliList',
                    'namaUnit'
                )
            );
        })->name('perda-perwali.index');
    });