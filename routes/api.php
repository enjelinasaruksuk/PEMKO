<?php

use App\Http\Controllers\Api\LoginApiController;
use App\Http\Controllers\Api\LogoutApiController;
use App\Http\Controllers\Api\RegisterApiController;
use App\Http\Controllers\Api\UserApiController;
use Illuminate\Support\Facades\Route;

Route::post('/login', [LoginApiController::class, 'login']);
Route::post('/register', [RegisterApiController::class, 'register']);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user', [UserApiController::class, 'show']);
    Route::post('/logout', [LogoutApiController::class, 'logout']);
});