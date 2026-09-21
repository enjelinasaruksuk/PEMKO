<?php

use App\Http\Controllers\Api\LoginApiController;
use App\Http\Controllers\Api\LogoutApiController;
use App\Http\Controllers\Api\RegisterApiController;
use App\Http\Controllers\Api\UserApiController;
use App\Http\Controllers\Api\UnitLayanan\ProfileApiController;
use App\Http\Controllers\Api\UnitLayanan\PerdaApiController;
use App\Http\Controllers\Api\UnitLayanan\PerwaliApiController;

use Illuminate\Support\Facades\Route;

Route::post('/login', [LoginApiController::class, 'login']);

Route::post('/register', [RegisterApiController::class, 'register']);

Route::middleware('auth:sanctum')->group(function () {

    Route::get('/user', [UserApiController::class, 'show']);

    Route::post('/logout', [LogoutApiController::class, 'logout']);

    Route::prefix('unit-layanan')->name('api.unit_layanan.')->group(function () {

        Route::get('/profile', [ProfileApiController::class, 'show'])
            ->name('profile.show');

        Route::put('/profile', [ProfileApiController::class, 'update'])
            ->name('profile.update');

        Route::get('/perda', [PerdaApiController::class, 'index'])
            ->name('perda.index');

        Route::post('/perda', [PerdaApiController::class, 'store'])
            ->name('perda.store');

        Route::put('/perda/{perda}', [PerdaApiController::class, 'update'])
            ->name('perda.update');

        Route::delete('/perda/{perda}', [PerdaApiController::class, 'destroy'])
            ->name('perda.destroy');

        Route::get('/perwali', [PerwaliApiController::class, 'index'])
            ->name('perwali.index');

        Route::post('/perwali', [PerwaliApiController::class, 'store'])
            ->name('perwali.store');

        Route::put('/perwali/{perwali}', [PerwaliApiController::class, 'update'])
            ->name('perwali.update');

        Route::delete('/perwali/{perwali}', [PerwaliApiController::class, 'destroy'])
            ->name('perwali.destroy');
    });
});