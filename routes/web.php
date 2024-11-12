<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ArtikelController;
use App\Http\Controllers\Auth\AdminLoginController;
use App\Http\Controllers\Auth\UserLoginController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\KomentarController;
use App\Http\Controllers\NotifikasiController;
use App\Http\Controllers\PengaturanController;
use App\Http\Controllers\PenggunaController;
use App\Http\Controllers\TagController;
use Illuminate\Support\Facades\Route;


Route::get('/', [HomeController::class, 'home'])->name('home');
Route::get('/contact', [HomeController::class, 'contact'])->name('contact');
Route::get('/categori', [HomeController::class, 'categori'])->name('categori');
Route::get('/about', [HomeController::class, 'about'])->name('about');
Route::get('/latest_news', [HomeController::class, 'latest_news'])->name('latest_news');
Route::get('/user/profile', [UserLoginController::class, 'profile'])->name('user.profile');
Route::get('/user/logout', [HomeController::class, 'logout'])->name('user.logout');


Route::middleware(['guest:admin', 'guest:user', 'guest:contributor'])->group(function () {
    Route::get('/admin/login', [UserLoginController::class, 'login'])->name('admin.login');
    Route::post('/admin/login', [UserLoginController::class, 'auth'])->name('admin.auth');

    Route::get('/user/login', [UserLoginController::class, 'loginUser'])->name('user.login');
    Route::post('/user/login', [UserLoginController::class, 'auth'])->name('user.auth');

    Route::get('/contributor/login', [UserLoginController::class, 'loginContributor'])->name('contributor.login');

    Route::get('/user/register', [UserLoginController::class, 'register'])->name('user.register');
});


Route::middleware(['role:admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/admin/logout', [AdminController::class, 'logout'])->name('admin.logout');
    Route::get('/admin/artikel', [ArtikelController::class, 'artikel'])->name('admin.artikel.berita');
    Route::get('/admin/kategori', [KategoriController::class, 'kategori'])->name('admin.artikel.kategori');
    Route::get('/admin/tag', [TagController::class, 'tag'])->name('admin.artikel.tag');
    Route::get('/admin/komentar', [KomentarController::class, 'komentar'])->name('admin.pengguna.komentar');
    Route::get('/admin/pengguna', [PenggunaController::class, 'pengguna'])->name('admin.pengguna.user');
    Route::get('/admin/notifikasi', [NotifikasiController::class, 'notifikasi'])->name('admin.pengguna.notifikasi');
    Route::get('/admin/pengaturan', [PengaturanController::class, 'pengaturan'])->name('admin.pengaturan');
    Route::get('/admin/notifikasi/pendaftar', [NotifikasiController::class, 'pendaftar'])->name('admin.pengguna.notifikasi.pendaftar');
    Route::get('/admin/notifikasi/penyetor', [NotifikasiController::class, 'penyetor'])->name('admin.pengguna.notifikasi.penyetor');
});

Route::get('/pengguna/logout', [PenggunaController::class, 'logout'])->name('pengguna.logout');

