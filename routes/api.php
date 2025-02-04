<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MasterUserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Route::middleware('auth:sanctum')->group(function() {
    Route::get('user-count', [DashboardController::class, 'dashboardUserCount'])->name('api.user.count');
    Route::get('users', [MasterUserController::class, 'userList'])->name('api.users');
// });
