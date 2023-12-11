<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Invoice\InvoiceController;
use App\Http\Controllers\Api\Auth\CustomerAuthController;

/*
|--------------------------------------------------------------------------
| Customer Api Routes
|--------------------------------------------------------------------------
*/

Route::prefix('auth')->group(function () {
    Route::post('login',   [CustomerAuthController::class, 'login']);
});

Route::middleware(['auth:sanctum', 'type.customer'])->group(function () {
    Route::prefix('auth')->group(function () {
        Route::get('user',   [CustomerAuthController::class, 'user']);
    });
});
