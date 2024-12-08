<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ArtikelController;
use App\Http\Controllers\Auth\AdminLoginController;
use App\Http\Controllers\Auth\UserLoginController;
use App\Http\Controllers\ContributorController;
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
Route::get('/berita/{slug}', [HomeController::class, 'showBerita'])->name('berita.show');
Route::post('/like-article/{slug}', [HomeController::class, 'likeArtikel'])->name('like.article');
Route::get('/artikel/{slug}', [HomeController::class, 'showArtikel'])->name('artikel.show');
Route::get('/latest-news', [HomeController::class, 'latest_news'])->name('latest_news');
Route::get('/api/lokasi', [HomeController::class, 'getLokasi']);

Route::middleware(['guest'])->group(function () {
    Route::get('/admin/login', [UserLoginController::class, 'login'])->name('admin.login');
    Route::post('/admin/login', [UserLoginController::class, 'auth'])->name('admin.auth');

    Route::get('/user/login', [UserLoginController::class, 'loginUser'])->name('user.login');
    Route::post('/user/login', [UserLoginController::class, 'auth'])->name('user.auth');

    Route::get('/contributor/login', [UserLoginController::class, 'loginContributor'])->name('contributor.login');

    Route::get('/user/register', [UserLoginController::class, 'register'])->name('user.register');
    Route::post('user/register', [PenggunaController::class, 'register'])->name('register');
});


Route::middleware(['role:admin'])->group(function () {
    // ADMIN
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/admin/profile', [UserLoginController::class, 'profileAdmin'])->name('admin.profile');
    Route::get('/admin/logout', [PenggunaController::class, 'logout'])->name('admin.logout');
    Route::get('/admin/profile/edit', [AdminController::class, 'editProfile'])->name('admin.profile.edit');
    Route::put('/admin/profile/edit', [PenggunaController::class, 'update'])->name('admin.profile.update');
    // Artikel
    Route::get('/admin/artikel', [ArtikelController::class, 'artikel'])->name('admin.artikel.berita');
    Route::get('/admin/artikel/tambah', [ArtikelController::class, 'create'])->name('admin.artikel.berita.create');
    Route::post('/admin/artikel/tambah', [ArtikelController::class, 'store'])->name('admin.artikel.berita.store');
    Route::get('/admin/artikel/edit/{id_artikel}', [ArtikelController::class, 'edit'])->name('admin.artikel.berita.edit');
    Route::put('/admin/artikel/update/{id_artikel}', [ArtikelController::class, 'update'])->name('admin.artikel.berita.update');
    Route::get('/admin/artikel/hapus/{id_artikel}', [ArtikelController::class, 'delete'])->name('admin.artikel.berita.delete');
    Route::get('/admin/artikel/detail/{id_artikel}', [ArtikelController::class, 'detail'])->name('admin.artikel.berita.detail');

    Route::get('/admin/kategori', [KategoriController::class, 'kategori'])->name('admin.artikel.kategori');
    Route::get('/admin/kategori/tambah', [KategoriController::class, 'create'])->name('admin.artikel.kategori.create');
    Route::post('/admin/kategori/tambah', [KategoriController::class, 'store'])->name('admin.artikel.kategori.store');
    Route::get('/admin/kategori/edit/{id_kategori}', [KategoriController::class, 'edit'])->name('admin.artikel.kategori.edit');
    Route::put('/admin/kategori/update/{id_kategori}', [KategoriController::class, 'update'])->name('admin.artikel.kategori.update');
    Route::get('/admin/kategori/hapus/{id_kategori}', [KategoriController::class, 'delete'])->name('admin.artikel.kategori.delete');


    Route::get('/admin/tag', [TagController::class, 'tag'])->name('admin.artikel.tag');
    Route::get('/admin/tag/tambah', [TagController::class, 'create'])->name('admin.artikel.tag.create');
    Route::post('/admin/tag/tambah', [TagController::class, 'store'])->name('admin.artikel.tag.store');
    Route::get('/admin/tag/kelola', [TagController::class, 'kelola'])->name('admin.artikel.kelola.tag');
    Route::post('/admin/tag/tambah/artikel', [TagController::class, 'storeArtikel'])->name('admin.artikel.artikel_tag.store');
    Route::post('/admin/tag/hapus/{id_tag}', [TagController::class, 'delete'])->name('admin.artikel.tag.delete');
    Route::get('/admin/tag/edit/{id_tag}', [TagController::class, 'edit'])->name('admin.artikel.tag.edit');
    Route::put('/admin/tag/update/{id_tag}', [TagController::class, 'update'])->name('admin.artikel.tag.update');

    // Pengguna
    Route::get('/admin/pengguna', [PenggunaController::class, 'pengguna'])->name('admin.pengguna.user');
    Route::get('/admin/pengguna/tambah', [PenggunaController::class, 'create'])->name('admin.pengguna.user.create');
    Route::get('/admin/pengguna/edit/{id}', [PenggunaController::class, 'edit'])->name('admin.pengguna.user.edit');
    Route::put('/admin/pengguna/edit/{id}', [PenggunaController::class, 'update'])->name('admin.pengguna.user.update');
    Route::delete('/admin/pengguna/delete/{id}', [PenggunaController::class, 'delete'])->name('admin.pengguna.user.delete');

    Route::get('/admin/notifikasi', [NotifikasiController::class, 'notifikasi'])->name('admin.pengguna.notifikasi');

    Route::get('/admin/notifikasi/pendaftar', [NotifikasiController::class, 'pendaftar'])->name('admin.pengguna.notifikasi.pendaftar');
    Route::post('/admin/notifikasi/approve/{id}', [NotifikasiController::class, 'approve'])->name('admin.notifikasi.approve');
    Route::delete('/pendaftaran/{id}/rejected', [NotifikasiController::class, 'rejected'])->name('pendaftaran.rejected');

    // Pengaturan
    Route::get('/admin/pengaturan', [PengaturanController::class, 'pengaturan'])->name('admin.pengaturan');
});

Route::middleware(['role:user,contributor'])->group(function () {
    Route::get('/user/profile', [UserLoginController::class, 'profileUser'])->name('user.profile');
    Route::get('/user/logout', [PenggunaController::class, 'logout'])->name('pengguna.logout');
    Route::get('/user/profile/edit', [PenggunaController::class, 'edit'])->name('pengguna.profile.edit');
    Route::put('/user/profile/edit', [PenggunaController::class, 'update'])->name('pengguna.profile.update');

    Route::get('/home/pedaftaran', [PenggunaController::class, 'pendaftaran'])->name('pendaftaran');
    Route::post('/home/pedaftaran/berhasil', [PenggunaController::class, 'store'])->name('pendaftaran.store');

    Route::get('/home/dashboard/contributor', [ContributorController::class, 'dashboard'])->name('contributor.dashboard');
    Route::get('/home/dashboard/contributor/create', [ContributorController::class, 'create'])->name('contributor.dashboard.create');
    Route::post('/home/dashboard/contributor/store', [ContributorController::class, 'store'])->name('contributor.dashboard.store');
    Route::get('/home/dashboard/contributor/edit/{id_artikel}', [ContributorController::class, 'edit'])->name('contributor.dashboard.edit');
    Route::put('/home/dashboard/contributor/update/{id_artikel}', [ContributorController::class, 'update'])->name('contributor.dashboard.update');
    Route::delete('/home/dashboard/contributor/delete/{id_artikel}', [ContributorController::class, 'delete'])->name('contributor.dashboard.delete');
});
