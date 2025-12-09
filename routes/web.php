<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\OTPController;
use Illuminate\Support\Facades\Auth;


use App\Http\Controllers\LoginController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ForgotPasswordController;
use App\Http\Controllers\LostFoundController;
use App\Models\LostFound;
use Illuminate\Http\Request;
use App\Http\Controllers\ItemController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Redirect root → login
Route::get('/', function () {
    return redirect('/login');
});

/*
|--------------------------------------------------------------------------
| Authentication
|--------------------------------------------------------------------------
*/
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

/*
|--------------------------------------------------------------------------
| Forgot Password
|--------------------------------------------------------------------------
*/
Route::get('/forgot-password', [ForgotPasswordController::class, 'form'])
    ->name('password.request');

Route::post('/forgot-password-check', [ForgotPasswordController::class, 'checkEmail'])
    ->name('password.check');

Route::get('/reset-password-manual/{email}', [ForgotPasswordController::class, 'showManualReset'])
    ->name('password.manual.reset');

Route::post('/reset-password-manual', [ForgotPasswordController::class, 'manualReset'])
    ->name('password.manual.update');

/*
|--------------------------------------------------------------------------
| Protected Routes (auth required)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth'])->group(function () {

    // HOME / DASHBOARD
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    Route::get('/dashboard', [LostFoundController::class, 'dashboard'])->name('dashboard');

    /*
    |--------------------------------------------------------------------------
    | LOST ITEMS (Barang Hilang)
    |--------------------------------------------------------------------------
    */
    Route::get('/lost-items', [LostFoundController::class, 'lostItems'])->name('lost-items.index');
    Route::get('/lost-items/create', [LostFoundController::class, 'createLost'])->name('lost-items.create');

    /*
    |--------------------------------------------------------------------------
    | FOUND ITEMS (Barang Ditemukan)
    |--------------------------------------------------------------------------
    */
    Route::get('/found-items', [LostFoundController::class, 'foundItems'])->name('found-items.index');
    Route::get('/found-items/create', [LostFoundController::class, 'createFound'])->name('found-items.create');

    /*
    |--------------------------------------------------------------------------
    | MY REPORTS (Laporan Saya)
    |--------------------------------------------------------------------------
    */
    Route::get('/my-reports', [LostFoundController::class, 'myReports'])->name('my-reports.index');

    /*
    |--------------------------------------------------------------------------
    | CRUD LOST & FOUND
    |--------------------------------------------------------------------------
    */
    Route::post('/lost-found', [LostFoundController::class, 'store'])->name('lost-found.store');
    Route::get('/lost-found/{id}', [LostFoundController::class, 'show'])->name('lost-found.show');
    Route::get('/lost-found/{id}/edit', [LostFoundController::class, 'edit'])->name('lost-found.edit');
    Route::put('/lost-found/{id}', [LostFoundController::class, 'update'])->name('lost-found.update');
    Route::delete('/lost-found/{id}', [LostFoundController::class, 'destroy'])->name('lost-found.destroy');

Route::get('/dashboard', function (Request $request) {

    $query = LostFound::query();

    // Search
    if ($request->search) {
        $query->where('nama_barang', 'like', '%' . $request->search . '%');
    }

    // Filter status
    if ($request->status != null && $request->status !== '') {
        $query->where('status', $request->status);
    }

    $items = $query->get();

    return view('dashboard', compact('items'));

})->middleware(['auth'])->name('dashboard');


Route::get('/items', [ItemController::class, 'index'])->name('items.index');
Route::get('/items/{id}', [ItemController::class, 'show'])->name('items.show');




});




