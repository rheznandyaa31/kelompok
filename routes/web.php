<?php

use App\Http\Controllers\ActivityController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CompensationController;
use App\Http\Controllers\DashboardController;
use App\Http\Middleware\AuthenticationMiddleware;
use App\Http\Middleware\RoleMiddleware;
use Illuminate\Support\Facades\Route;

Route::get('/login', [AuthController::class, 'login']);
Route::post('/login', [AuthController::class, 'login_user']);


Route::get('/', function () {
    return redirect('/dashboard');
});

Route::get('/generate-pdf', [CompensationController::class, 'generate_pdf']);

Route::middleware(AuthenticationMiddleware::class)->group(function () {
    Route::middleware(RoleMiddleware::class . ':mahasiswa')->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index']);
        Route::get('/activity', [ActivityController::class, 'index']);
        Route::get('/compensation', [CompensationController::class, 'index']);
    });

    Route::get('/logout', [AuthController::class, 'logout']);
});
