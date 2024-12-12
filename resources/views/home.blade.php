@extends('layouts.app')
@section('title', 'Home')
@section('konten')
<style>
    .nice-select.swal2-select {
        display: none !important;
        /* Sembunyikan nice-select */
    }
</style>
@if(session('successPendaftaran'))
<script>
    Swal.fire({
        title: 'Pendaftaran Berhasil!',
        text: 'Selamat Pendaftaran Anda Berhasil.',
        icon: 'success',
        showConfirmButton: true, // Sembunyikan tombol OK
    });
</script>
@endif
<main>
    <!-- Trending Area Start -->
    <div class="trending-area fix">
        <div class="container">
            <div class="trending-main">
                <!-- Trending Tittle -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="trending-tittle">
                            <strong>Trending now</strong>
                            <!-- <p>Rem ipsum dolor sit amet, consectetur adipisicing elit.</p> -->
                            <div class="trending-animated">
                                <ul id="js-news" class="js-hidden">
                                    @foreach($artikelsTrending as $artikel)
                                    <li class="news-item">{{ $artikel->judul }}</li>
                                    @endforeach
                                </ul>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-8">
                        <!-- Trending Top -->
                        @if ($trendingLatest)
                        <div class="trending-top mb-30">
                            <div class="trend-top-img">
                                <img src="{{ asset('storage/' . $trendingLatest->media_utama) }}" alt="{{ $trendingLatest->judul }}">
                                <div class="trend-top-cap">
                                    <span>{{ $trendingLatest->kategori->nama_kategori }}</span>
                                    <h2><a href="{{ route('berita.show', $trendingLatest->slug) }}">{{ $trendingLatest->judul }}</a></h2>
                                </div>
                            </div>
                        </div>
                        @endif
                        <!-- Trending Bottom -->
                        <div class="trending-bottom">
                            <div class="row">
                                @foreach($artikelsTrending as $artikel)
                                <div class="col-lg-4">
                                    <div class="single-bottom mb-35">
                                        <div class="trend-bottom-img mb-30">
                                            <img src="{{ asset('storage/' . $artikel->media_utama) }}" alt="" style="width: 150px; height: 150px; object-fit: cover;">
                                        </div>
                                        <div class="trend-bottom-cap">
                                            <span class="color1">{{ $artikel->kategori->nama_kategori }}</span>
                                            <h4><a href="{{ route('berita.show', $artikel->slug) }}">{{ $artikel->judul }}</a></h4>
                                            <p>{{ Str::limit(strip_tags($artikel->konten), 50) }}</p>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <!-- Riht content -->
                    <div class="col-lg-4">
                        @foreach($artikelsHighlight as $artikel)
                        <div class="trand-right-single d-flex">
                            <div class="trand-right-img">
                                <img src="{{ asset('storage/'. $artikel->media_utama) }}" alt="" style="width: 100px; height: 100px; object-fit: cover;">
                            </div>
                            <div class="trand-right-cap">
                                <span class="color1">{{ $artikel->kategori->nama_kategori }}</span>
                                <h4><a href="{{ route('berita.show', $artikel->slug) }}">{{ $artikel->judul }}</a></h4>
                                <p>{{ Str::limit(strip_tags($artikel->konten), 30) }}</p>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Trending Area End -->

    <!-- Weekly-News Start -->
    <div class="weekly-news-area pt-50">
        <div class="container">
            <div class="weekly-wrapper">
                <!-- Section Title -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="section-tittle mb-30">
                            <h3>Top News</h3>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="weekly-news-active dot-style d-flex dot-style">
                            @php
                            $minimumPosts = 4;
                            $currentPosts = count($trendingLatestAll);

                            // Jika jumlah postingan kurang dari 4, ulangi dari awal
                            if ($currentPosts < $minimumPosts) { $index=0; while (count($trendingLatestAll) < $minimumPosts) { $trendingLatestAll[]=$trendingLatestAll[$index]; $index=($index + 1) % $currentPosts; } } @endphp @foreach($trendingLatestAll as $artikel) <div class="weekly-single">
                                <div class="weekly-img">
                                    <img src="{{ asset('storage/' . $artikel->media_utama) }}" alt="" style="width: 250px; height: 250px; object-fit: cover;">
                                </div>
                                <div class="weekly-caption">
                                    <span class="color1">{{ $artikel->kategori->nama_kategori }}</span>
                                    <h4><a href="{{ route('berita.show', $artikel->slug) }}">{{ $artikel->judul }}</a></h4>
                                </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    <!-- End Weekly-News -->

    <!-- Weekly2-News Start -->
    <div class="weekly2-news-area weekly2-pading gray-bg">
        <div class="container">
            <div class="weekly2-wrapper">
                <!-- Section Title -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="section-tittle mb-30">
                            <h3>Weekly Top News</h3>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="weekly2-news-active dot-style d-flex dot-style">
                            @php
                            $minimumPosts = 5;
                            $currentPosts = count($highlightLatestAll);

                            $allArticles = $highlightLatestAll;

                            // Jika jumlah postingan kurang dari 5, ulangi dari awal
                            if ($currentPosts < $minimumPosts) { $index=0; while (count($allArticles) < $minimumPosts) { $allArticles[]=$highlightLatestAll[$index]; $index=($index + 1) % $currentPosts; } } @endphp @foreach($allArticles as $t) <div class="weekly2-single">
                                <div class="weekly2-img">
                                    <img src="{{ asset('storage/' . $t->media_utama) }}" alt="" style="width: 200px; height: 200px; object-fit: cover;">
                                </div>
                                <div class="weekly2-caption">
                                    <span class="color1">{{ $t->kategori->nama_kategori }}</span>
                                    <h4><a href="{{ route('berita.show', $artikel->slug) }}">{{ $t->judul }}</a></h4>
                                    <p>{{ Str::limit(strip_tags($t->konten), 50) }}</p>
                                </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>

</main>
@endsection
<!-- End Pagination -->