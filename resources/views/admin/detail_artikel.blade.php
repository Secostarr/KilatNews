@extends('admin.layouts.app')
@section('title', 'Dashboard')
@section('content')

<style>
    .card-img-top {
        width: 100%;
        /* Gambar menyesuaikan lebar kontainer */
        max-height: 300px;
        /* Maksimal tinggi gambar */
        object-fit: cover;
        /* Gambar tetap proporsional */
        border-radius: 8px;
        /* Memberikan efek rounded */
    }

    .card-content {
        font-size: 14px;
        /* Membuat teks lebih kecil */
    }

    .text-shadow {
        text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
        font-size: 2.5rem;
        /* Memperbesar ukuran teks */
        color: #003399;
        /* Warna biru yang lebih mencolok */
    }
</style>

<div class="container-fluid pt-3">
    <!-- Artikel Container -->
    <div class="row bg-white rounded shadow-sm p-4 mx-0">
        <!-- Header -->
        <div class="col-12 mb-4 text-center">
            <h1 class="display-6 text-primary fw-bold text-uppercase">
                <strong>{{ $artikel->judul }}</strong>
            </h1>
            <p class="text-muted">Dipublikasikan pada {{ $artikel->created_at->format('d M Y') }}</p>
        </div>

        <!-- Foto dan Informasi Artikel -->
        <div class="col-12 col-md-6">
            <div class="card border-0 shadow-sm">
                <img src="{{ asset('storage/' . $artikel->media_utama) }}"
                    class="card-img-top"
                    alt="Gambar Artikel">
            </div>
        </div>

        <div class="col-12 col-md-6 d-flex flex-column justify-content-between">
            <div class="card border-0 bg-light shadow-sm p-4 h-100">
                <div class="mb-3 d-flex align-items-center">
                    <i class="fas fa-link text-primary me-2"></i>
                    <span class="text-secondary me-2 fw-bold">Slug:</span>
                    <span class="text-dark">{{ strip_tags($artikel->slug) }}</span>
                </div>
                <div class="mb-3 d-flex align-items-center">
                    <i class="fas fa-user text-info me-2"></i>
                    <span class="text-secondary me-2 fw-bold">Penulis:</span>
                    <span class="text-dark">{{ $artikel->user->nama }}</span>
                </div>
                <div class="mb-3 d-flex align-items-center">
                    <i class="fas fa-folder-open text-warning me-2"></i>
                    <span class="text-secondary me-2 fw-bold">Jenis Kategori:</span>
                    <span class="text-dark">{{ $artikel->kategori->nama_kategori }}</span>
                </div>
                <div class="mb-3 d-flex align-items-center">
                    <i class="fas fa-tags text-success me-2"></i>
                    <span class="text-secondary me-2 fw-bold">Tag:</span>
                    <span class="text-dark">{{ $artikel->ArtikelToTag->nama_tag }}</span>
                </div>
                <div class="mb-3 d-flex align-items-center">
                    <i class="fas fa-star text-danger me-2"></i>
                    <span class="text-secondary me-2 fw-bold">Highlight:</span>
                    <span class="text-dark">{{ $artikel->highlight ? 'Ya' : 'Tidak' }}</span>
                </div>
                <div class="d-flex align-items-center">
                    <i class="fas fa-fire text-warning me-2"></i>
                    <span class="text-secondary me-2 fw-bold">Trending:</span>
                    <span class="text-dark">{{ $artikel->trending ? 'Ya' : 'Tidak' }}</span>
                </div>
            </div>
        </div>


        <!-- Konten dan Lokasi -->
        <div class="col-12 mt-4">
            <div class="card border-0 bg-light shadow-sm p-4">
                <h2 class="text-secondary">Konten</h2>
                <p class="text-dark" style="text-align: justify;">{{ strip_tags($artikel->konten) }}</p>
                <h2 class="text-secondary">Lokasi Berita</h2>
                <p class="text-dark">{{ $artikel->lokasi ?? 'Lokasi tidak tersedia' }}</p>
            </div>
        </div>

        <!-- Tombol Kembali -->
        <div class="col-12 text-center mt-4">
            <a href="{{ Route('admin.artikel.berita') }}" class="btn btn-primary">
                <i class="fas fa-arrow-left"></i> Kembali ke Daftar Artikel
            </a>
        </div>

        <!-- Statistik Artikel -->
        <div class="col-12 mt-4 text-center">
            <div class="d-flex justify-content-center gap-4">
                <div class="text-center">
                    <i class="fas fa-eye text-secondary fa-2x"></i>
                    <p class="mt-1 text-dark">{{ $artikel->views ?? 0 }} Views</p>
                </div>
                <div class="text-center">
                    <i class="fas fa-thumbs-up text-primary fa-2x"></i>
                    <p class="mt-1 text-dark">{{ $artikel->likes ?? 0 }} Likes</p>
                </div>
                <div class="text-center">
                    <i class="fas fa-comments text-success fa-2x"></i>
                    <p class="mt-1 text-dark">{{ $artikel->comments_count ?? 0 }} Komentar</p>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection