<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\PosController;
use Illuminate\Support\Facades\Route;

// 1. Halaman Beranda Utama (Portal Realtime & Promosi Jasa)
Route::get('/', [PosController::class, 'landing'])->name('landing');

// 2. Autentikasi (Halaman Login & Register)
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// 3. Panel Aplikasi Dashboard
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [PosController::class, 'index'])->name('dashboard');
    
    // Fitur Ekspor Pendapatan ke CSV / Google Sheets
    Route::get('/export-revenue', [PosController::class, 'exportRevenue'])->name('export.revenue');

    // CRUD Produk
    Route::post('/product', [PosController::class, 'storeProduct'])->name('product.store');
    Route::put('/product/{id}', [PosController::class, 'updateProduct'])->name('product.update');
    Route::delete('/product/{id}', [PosController::class, 'destroyProduct'])->name('product.destroy');

    // Transaksi Kasir POS
    Route::post('/transaction', [PosController::class, 'storeTransaction'])->name('pos.transaction');
    Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [PosController::class, 'index'])->name('dashboard');
    Route::get('/export-revenue', [PosController::class, 'exportRevenue'])->name('export.revenue');

    // CRUD Produk
    Route::post('/product', [PosController::class, 'storeProduct'])->name('product.store');
    Route::put('/product/{id}', [PosController::class, 'updateProduct'])->name('product.update');
    Route::delete('/product/{id}', [PosController::class, 'destroyProduct'])->name('product.destroy');

    // Transaksi Kasir POS
    Route::post('/transaction', [PosController::class, 'storeTransaction'])->name('pos.transaction');

    // Biaya Pengeluaran (Expense Tracker)
    Route::post('/expense', [PosController::class, 'storeExpense'])->name('expense.store');
    Route::delete('/expense/{id}', [PosController::class, 'destroyExpense'])->name('expense.destroy');
});
});