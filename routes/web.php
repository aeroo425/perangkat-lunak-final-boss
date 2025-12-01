<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ForgotPasswordController;
use App\Http\Controllers\HomeController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Default → login
Route::get('/', function () {
    return redirect('/login');
});

// =========================
// AUTH
// =========================
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

// =========================
// FORGOT PASSWORD
// =========================
Route::get('/forgot-password', [ForgotPasswordController::class, 'form'])
    ->name('password.request');

Route::post('/forgot-password-check', [ForgotPasswordController::class, 'checkEmail'])
    ->name('password.check');

Route::get('/reset-password-manual/{email}', [ForgotPasswordController::class, 'showManualReset'])
    ->name('password.manual.reset');

Route::post('/reset-password-manual', [ForgotPasswordController::class, 'manualReset'])
    ->name('password.manual.update');

// =========================
// DASHBOARD
// =========================

// Main dashboard
Route::get('/dashboard', [HomeController::class, 'index'])
    ->middleware(['auth'])
    ->name('dashboard');

// Redirect lama /home → /dashboard
Route::get('/home', function () {
    return redirect('/dashboard');
});
