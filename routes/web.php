<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KategoriTransportController;
use App\Http\Controllers\AkunAkuntansiController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\BiayaOperasionalController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;

// Auth Routes
Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login'])->name('login.post');
    Route::get('/register', [RegisterController::class, 'showRegisterForm'])->name('register');
    Route::post('/register', [RegisterController::class, 'register'])->name('register.post');
});

Route::post('/logout', [LoginController::class, 'logout'])->middleware('auth')->name('logout');

Route::get('/', function () {
    return redirect()->route('dashboard');
})->middleware('auth');

Route::middleware('auth')->group(function () {
    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Kategori Transport - Master Data
    Route::resource('kategori-transport', KategoriTransportController::class);

    // Akun Akuntansi - Master Data
    Route::resource('akun-akuntansi', AkunAkuntansiController::class);

    // Orders - Transaksi
    Route::resource('orders', OrderController::class);

    // Biaya Operasional - Transaksi
    Route::resource('biaya-operasional', BiayaOperasionalController::class);

    // Laporan Keuangan
    Route::prefix('laporan')->name('laporan.')->group(function () {
        Route::get('/', [LaporanController::class, 'index'])->name('index');
        Route::get('pendapatan', [LaporanController::class, 'laporanPendapatan'])->name('pendapatan');
        Route::get('laba-rugi', [LaporanController::class, 'laporanLabaRugi'])->name('laba-rugi');
        Route::get('neraca', [LaporanController::class, 'laporanNeraca'])->name('neraca');
        Route::get('perubahan-modal', [LaporanController::class, 'laporanPerubahanModal'])->name('perubahan-modal');
    });
});
