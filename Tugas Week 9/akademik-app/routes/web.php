<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KelolaMateriController;
use App\Http\Controllers\KelolaNilaiController;
use App\Http\Controllers\MateriController;
use App\Http\Controllers\NilaiController;
use App\Http\Controllers\PanelController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

// ---------- Publik (guest) ----------
Route::view('/', 'welcome')->name('home');

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.attempt');
});

Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth')->name('logout');

// ---------- Semua role yang sudah login ----------
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', DashboardController::class)->name('dashboard');
    Route::get('/materi', [MateriController::class, 'index'])->name('materi.index'); // lihat materi
});

// ---------- Admin saja ----------
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin', [PanelController::class, 'admin'])->name('panel.admin');
    Route::resource('admin/users', UserController::class)->except('show')->names('admin.users'); // manajemen pengguna
});

// ---------- Dosen saja ----------
Route::middleware(['auth', 'role:dosen'])->group(function () {
    Route::get('/dosen', [PanelController::class, 'dosen'])->name('panel.dosen');
});

// ---------- Mahasiswa saja ----------
Route::middleware(['auth', 'role:mahasiswa'])->group(function () {
    Route::get('/mahasiswa', [PanelController::class, 'mahasiswa'])->name('panel.mahasiswa');
});

// ---------- Admin & Dosen: kelola materi dan nilai ----------
Route::middleware(['auth', 'role:admin,dosen'])->group(function () {
    Route::resource('kelola-materi', KelolaMateriController::class)
        ->except('show')->parameters(['kelola-materi' => 'materi']);
    Route::resource('kelola-nilai', KelolaNilaiController::class)
        ->except('show')->parameters(['kelola-nilai' => 'nilai']);
});

// ---------- Admin & Mahasiswa: lihat nilai pribadi ----------
Route::middleware(['auth', 'role:admin,mahasiswa'])->group(function () {
    Route::get('/nilai-saya', [NilaiController::class, 'saya'])->name('nilai.saya');
});
