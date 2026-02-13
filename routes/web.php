<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PengaduanController;
use Illuminate\Support\Facades\Route;

// Halaman welcome
Route::get('/', function () {
    return view('welcome');
});

// Route Profile
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'show'])
        ->name('profile.show');
});

// Redirect setelah login ke dashboard sesuai role
Route::middleware('auth')->group(function(){
    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('dashboard');
});

// Dashboard Admin
Route::middleware(['auth', 'role:admin'])->group(function(){
    Route::get('/admin/dashboard', [DashboardController::class, 'admin'])
        ->name('admin.dashboard');
});

// Dashboard Petugas
Route::middleware(['auth', 'role:petugas'])->group(function(){
    Route::get('/petugas/dashboard', [DashboardController::class, 'petugas'])
        ->name('petugas.dashboard');
});

// Dashboard Masyarakat + Pengaduan
Route::middleware(['auth', 'role:masyarakat'])->group(function(){
    Route::get('/masyarakat/dashboard', [DashboardController::class, 'masyarakat'])
        ->name('masyarakat.dashboard');

    // Route store pengaduan (manual)
    Route::post('/pengaduan', [PengaduanController::class, 'store'])
        ->name('pengaduan.store');

    // Semua route CRUD pengaduan
    Route::resource('pengaduan', PengaduanController::class);
    
      
});

// Auth routes (login, register, logout)
require __DIR__.'/auth.php';
