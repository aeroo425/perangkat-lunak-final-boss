<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ForgotPasswordController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LostFoundController;
use App\Http\Controllers\ItemController;

/*
|--------------------------------------------------------------------------
| Redirect root
|--------------------------------------------------------------------------
*/
Route::get('/', function () {
    return redirect()->route('login');
});

/*
|--------------------------------------------------------------------------
| AUTH
|--------------------------------------------------------------------------
*/
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

/*
|--------------------------------------------------------------------------
| FORGOT PASSWORD
|--------------------------------------------------------------------------
*/
Route::get('/forgot-password', [ForgotPasswordController::class, 'form'])->name('password.request');
Route::post('/forgot-password-check', [ForgotPasswordController::class, 'checkEmail'])->name('password.check');
Route::get('/reset-password-manual/{email}', [ForgotPasswordController::class, 'showManualReset'])->name('password.manual.reset');
Route::post('/reset-password-manual', [ForgotPasswordController::class, 'manualReset'])->name('password.manual.update');

/*
|--------------------------------------------------------------------------
| PROTECTED ROUTES
|--------------------------------------------------------------------------
*/
Route::middleware(['auth'])->group(function () {

    // Dashboard
    Route::get('/dashboard', [LostFoundController::class, 'dashboard'])->name('dashboard');

    // List semua item
    Route::get('/list-items', [LostFoundController::class, 'listItems'])->name('list-items.index');

    // Lost items
    Route::get('/lost-items', [LostFoundController::class, 'lostItems'])->name('lost-items.index');
    Route::get('/lost-items/create', [LostFoundController::class, 'createLost'])->name('lost-items.create');

    // Found items
    Route::get('/found-items', [LostFoundController::class, 'foundItems'])->name('found-items.index');
    Route::get('/found-items/create', [LostFoundController::class, 'createFound'])->name('found-items.create');

    // My reports
    Route::get('/my-reports', [LostFoundController::class, 'myReports'])->name('my-reports.index');

    // CRUD Lost & Found
    Route::post('/lost-found', [LostFoundController::class, 'store'])->name('lost-found.store');
    Route::get('/lost-found/{id}', [LostFoundController::class, 'show'])->name('lost-found.show');
    Route::get('/lost-found/{id}/edit', [LostFoundController::class, 'edit'])->name('lost-found.edit');
    Route::put('/lost-found/{id}', [LostFoundController::class, 'update'])->name('lost-found.update');
    Route::delete('/lost-found/{id}', [LostFoundController::class, 'destroy'])->name('lost-found.destroy');

    // Search
    Route::get('/items/search', [LostFoundController::class, 'search'])->name('items.search');

});


Route::middleware(['auth'])->group(function () {

    Route::get('/dashboard', [LostFoundController::class, 'dashboard'])
        ->name('dashboard');

    Route::get('/list-items', [LostFoundController::class, 'listItems'])
        ->name('list-items.index');

    Route::get('/lost-items', [LostFoundController::class, 'lostItems'])
        ->name('lost-items.index');

    Route::get('/found-items', [LostFoundController::class, 'foundItems'])
        ->name('found-items.index');

    Route::get('/my-reports', [LostFoundController::class, 'myReports'])
        ->name('my-reports.index');

    // DETAIL ITEM (SATU-SATUNYA)
    Route::get('/lost-found/{id}', [LostFoundController::class, 'show'])
        ->name('lost-found.show');
});

Route::get('/items/{id}', [ItemController::class, 'show'])
    ->name('items.show_item');

Route::post('/items/{id}/klaim', [ItemController::class, 'klaim'])
    ->name('items.klaim');

Route::get('/dashboard', [HomeController::class, 'index'])
    ->name('dashboard')
    ->middleware('auth');


   
