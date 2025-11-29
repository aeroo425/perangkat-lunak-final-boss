<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\OTPController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ForgotPasswordController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/', function () {
    return redirect('/login');
});

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

// FORGOT PASSWORD
// 1. Halaman form lupa password
Route::get('/forgot-password', [ForgotPasswordController::class, 'form'])
    ->name('password.request');

// 2. Cek email — kalau ada → redirect ke reset password manual
Route::post('/forgot-password-check', [ForgotPasswordController::class, 'checkEmail'])
    ->name('password.check');

// 3. Halaman reset password manual (tanpa email asli)
Route::get('/reset-password-manual/{email}', [ForgotPasswordController::class, 'showManualReset'])
    ->name('password.manual.reset');

// 4. Submit password baru
Route::post('/reset-password-manual', [ForgotPasswordController::class, 'manualReset'])
    ->name('password.manual.update');

Route::get('/forgot-password', [ForgotPasswordController::class, 'form'])
    ->name('password.request');

