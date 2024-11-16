<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use Laravel\Sanctum\Http\Controllers\CsrfCookieController;
use App\Http\Controllers\Api\TasksController;


Route::prefix('v1')->group(function () {
// auth
    Route::post('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/send-email-verification', [AuthController::class, 'sendEmailVerification']);
    Route::post('/verify-code', [AuthController::class, 'verifyCode']);
    Route::post('/reset-password', [AuthController::class, 'resetPassword']);
    // Route::post('/update-password', [AuthController::class, 'updatePassword']);
    Route::post('/logout', [AuthController::class, 'logout']);

    // Task routes
    Route::get('/tasks', [TasksController::class, 'index']); // Get data Task
    Route::post('/submission-task', [TasksController::class, 'submitTask']); 
    // Route::middleware('auth:api')->post('/submit-task', [TasksController::class, 'submitTask']);

    // Dashboard

    // Activities

    // History

    // Notifications
});

// Sanctum CSRF cookie route
Route::get('/sanctum/csrf-cookie', [CsrfCookieController::class, 'show']);