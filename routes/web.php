<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PengaduanController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TanggapanController;
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
    Route::get('/petugas/dashboard', [TanggapanController::class, 'index'])
        ->name('petugas.dashboard');

    Route::get('/tanggapan/create/{id}', [TanggapanController::class, 'create'])
        ->name('tanggapan.create');

    Route::post('/tanggapan', [TanggapanController::class, 'store'])
        ->name('tanggapan.store');

    Route::get('/pengaduan/{id}', [PengaduanController::class, 'show'])
        ->name('pengaduan.show');

});

// Dashboard Masyarakat + Pengaduan
Route::middleware(['auth', 'role:masyarakat'])->group(function(){
    Route::get('/masyarakat/dashboard', [PengaduanController::class, 'index'])
        ->name('masyarakat.dashboard');

    // Route store pengaduan (manual)
    Route::post('/pengaduan', [PengaduanController::class, 'store'])
        ->name('pengaduan.store');

    // Semua route CRUD pengaduan
    Route::resource('pengaduan', PengaduanController::class);


});

// Auth routes (login, register, logout)
require __DIR__.'/auth.php';
