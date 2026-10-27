<?php

use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\KecamatanController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\MasyarakatAuthController;

// Registrasi & Login Warga
Route::get('/register', [MasyarakatAuthController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [MasyarakatAuthController::class, 'register'])->name('register.submit');
Route::get('/login', [MasyarakatAuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [MasyarakatAuthController::class, 'login'])->name('login.submit');
Route::post('/logout', [MasyarakatAuthController::class, 'logout'])->name('logout');


// Halaman publik
Route::get('/', [KecamatanController::class, 'index'])
    ->name('kecamatan.home');

Route::post('/aspirasi', [KecamatanController::class, 'aspirasi'])
    ->name('kecamatan.aspirasi');

// Login admin
Route::get('/admin/login', [AdminAuthController::class, 'showLoginForm'])
    ->name('admin.login');

Route::post('/admin/login', [AdminAuthController::class, 'login'])
    ->name('admin.login.submit');

// Logout admin
Route::post('/admin/logout', [AdminAuthController::class, 'logout'])
    ->name('admin.logout');

// Panel admin terlindungi
Route::middleware('auth')->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])
        ->name('dashboard');

    Route::patch('/aspirasi/{id}/status', [AdminDashboardController::class, 'updateStatus'])
        ->name('aspirasi.status');

    Route::delete('/aspirasi/{id}', [AdminDashboardController::class, 'destroy'])
        ->name('aspirasi.destroy');
});