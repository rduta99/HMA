<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MasterUserController;
use App\Http\Controllers\SettingController;
use Illuminate\Support\Facades\Route;

Route::middleware(['guest'])->group(function() {
    Route::get('/', [AuthController::class, 'index']);
    Route::get('/login', [AuthController::class, 'index'])->name('auth.login');

    Route::post('/login-attempt', [AuthController::class, 'loginAttempt'])->name('auth.login.attempt');
});

Route::middleware(['web', ])->group(function() {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/user', [MasterUserController::class, 'index'])->name('master.user');
    Route::get('/create-user', [MasterUserController::class, 'create'])->name('master.user.create.view');
    Route::post('/user', [MasterUserController::class, 'createProcess'])->name('master.user.create');
    Route::get('/user/{id}', [MasterUserController::class, 'detail'])->name('master.user.detail');
    Route::post('/user/{id}', [MasterUserController::class, 'updateUser'])->name('master.user.update');
    Route::get('/user/{id}/delete', [MasterUserController::class, 'deleteUser'])->name('master.user.delete');

    Route::get('setting', [SettingController::class, 'index'])->name('setting');
    Route::post('setting', [SettingController::class, 'update'])->name('setting.update');
});
