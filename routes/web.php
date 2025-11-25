<?php

use Illuminate\Support\Facades\Route;

// Controllers
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\HomeController;

// Default redirect
Route::get('/', function () {
    return redirect('/login');
});

// LOGIN
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// REGISTER
Route::get('/register', [RegisterController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);

// FORGOT PASSWORD
Route::get('/forgot-password', [ForgotPasswordController::class, 'showLinkRequestForm'])
    ->name('password.request');
Route::post('/forgot-password', [ForgotPasswordController::class, 'sendResetLinkEmail'])
    ->name('password.email');

// HOME / DASHBOARD
Route::get('/home', [HomeController::class, 'index'])->name('home')->middleware('auth');
Route::get('/dashboard', [HomeController::class, 'index'])->middleware('auth');
