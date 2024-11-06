<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ArtikelController;
use App\Http\Controllers\Auth\AdminLoginController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\KomentarController;
use App\Http\Controllers\NotifikasiController;
use App\Http\Controllers\PengaturanController;
use App\Http\Controllers\PenggunaController;
use App\Http\Controllers\TagController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/admin/login', [AdminLoginController::class, 'login'])->name('admin.login');
Route::post('/admin/login', [AdminLoginController::class, 'auth'])->name('admin.auth');

Route::middleware(['admin'])->group(function () {
Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
Route::get('/admin/logout', [AdminController::class, 'logout'])->name('admin.logout');
Route::get('/admin/artikel', [ArtikelController::class, 'artikel'])->name('admin.artikel');
Route::get('/admin/kategori', [KategoriController::class, 'kategori'])->name('admin.kategori');
Route::get('/admin/tag', [TagController::class, 'tag'])->name('admin.tag');
Route::get('/admin/komentar', [KomentarController::class, 'komentar'])->name('admin.komentar');
Route::get('/admin/pengguna', [PenggunaController::class, 'pengguna'])->name('admin.pengguna');
Route::get('/admin/notifikasi', [NotifikasiController::class, 'notifikasi'])->name('admin.notifikasi');
Route::get('/admin/pengaturan', [PengaturanController::class, 'pengaturan'])->name('admin.pengaturan');


Route::get('/admin/pengaturan', [PengaturanController::class, 'pengaturan'])->name('admin.pengaturan');
});