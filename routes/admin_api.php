<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Invoice\InvoiceController;
use App\Http\Controllers\Api\Auth\AdminAuthController;

/*
|--------------------------------------------------------------------------
| Admin Api Routes
|--------------------------------------------------------------------------
*/

Route::prefix('auth')->group(function () {
    Route::post('login',   [AdminAuthController::class, 'login']);
});

Route::middleware(['auth:sanctum', 'type.admin'])->group(function () {

    Route::prefix('auth')->group(function () {
        Route::get('user',   [AdminAuthController::class, 'user']);
    });

    Route::prefix('invoices')->group(function () {
        Route::get('show/{id}', [InvoiceController::class, 'show'])->name('invoices.show');
        Route::post('store',    [InvoiceController::class, 'store'])->name('invoices.store');
    });
});

