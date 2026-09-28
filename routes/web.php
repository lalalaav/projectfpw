<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PosController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Landing Page
Route::get('/', function () {
    return view('welcome');
});

/*
|--------------------------------------------------------------------------
| Authentication
|--------------------------------------------------------------------------
*/

// Login
Route::get('/login', [AuthController::class, 'create'])
    ->middleware('guest')
    ->name('login');

Route::post('/login', [AuthController::class, 'store'])
    ->middleware('guest')
    ->name('login.store');

// Logout
Route::post('/logout', [AuthController::class, 'destroy'])
    ->middleware('auth')
    ->name('logout');

/*
|--------------------------------------------------------------------------
| Dashboard
|--------------------------------------------------------------------------
*/

Route::get('/dashboard', function () {
    return view('dashboard');
})
    ->middleware('auth')
    ->name('dashboard');

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'role:admin'])->group(function () {

    // Kelola kategori
    Route::resource('categories', CategoryController::class);

    // Kelola produk
    Route::resource('products', ProductController::class);

    // Kelola akun user
    Route::resource('users', UserController::class);

    // Laporan penjualan
    Route::get('/reports/sales', [ReportController::class, 'sales'])
        ->name('report.sales');
});

/*
|--------------------------------------------------------------------------
| POS Routes
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'role:admin,kasir'])->group(function () {

    // Halaman POS
    Route::get('/pos', [PosController::class, 'index'])
        ->name('pos.index');

    // Simpan transaksi
    Route::post('/pos', [PosController::class, 'store'])
        ->name('pos.store');
});