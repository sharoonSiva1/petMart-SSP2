<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ProductController;

Route::post('/login', [App\Http\Controllers\Api\AuthController::class, 'login']);
Route::post('/register', [App\Http\Controllers\Api\AuthController::class, 'register']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [App\Http\Controllers\Api\AuthController::class, 'logout']);
    Route::post('/logout-all', [App\Http\Controllers\Api\AuthController::class, 'logoutAllDevices']);
    Route::get('/user', [App\Http\Controllers\Api\AuthController::class, 'user']);

    Route::prefix('v1')->group(function () {
        Route::get('/products', [ProductController::class, 'index']);
        Route::get('/products/{id}', [ProductController::class, 'show']);
        Route::delete('/products/{id}', [ProductController::class, 'destroy'])->middleware('ability:delete');

        // Admin Analytics
        Route::get('/admin/analytics', [App\Http\Controllers\Api\AdminAnalyticsController::class, 'index'])
            ->middleware('ability:admin');
    });
});
