<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;

Route::middleware(['guest'])->group(function() {
    Route::get('/', [AuthController::class, 'index']);
    Route::get('/login', [AuthController::class, 'index'])->name('auth.login');

    Route::post('/login-attempt', [AuthController::class, 'loginAttempt'])->name('auth.login.attempt');
});

Route::middleware('web')->group(function() {
    Route::get('/dashboard', [DashboardController::class, 'index']);
});
