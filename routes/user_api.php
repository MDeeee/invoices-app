<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Auth\UserAuthController;

/*
|--------------------------------------------------------------------------
| User Api Routes
|--------------------------------------------------------------------------
*/

Route::prefix('auth')->group(function () {
    Route::post('login',   [UserAuthController::class, 'login']);
});

Route::middleware(['auth:sanctum', 'type.user'])->group(function () {
    Route::prefix('auth')->group(function () {
        Route::get('user', [UserAuthController::class, 'user']);
    });
});
