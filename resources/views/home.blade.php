@extends('layouts.app')
@section('title', 'Home')
@section('konten')

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
                            <div class="trending-animated">
                                <ul id="js-news" class="js-hidden">
                                    <li class="news-item">Headline 1</li>
                                    <li class="news-item">Headline 2</li>
                                    <li class="news-item">Headline 3</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-8">
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

                        <div class="trending-bottom">
                            <h3>More Trending Articles</h3>
                            <div class="row">
                                @foreach ($artikelsTrending as $artikel)
                                <div class="col-lg-4">
                                    <div class="single-bottom mb-35">
                                        <div class="trend-bottom-img mb-30">
                                            <img src="{{ asset('storage/' . $artikel->media_utama) }}" alt="{{ $artikel->judul }}">
                                        </div>
                                        <div class="trend-bottom-cap">
                                            <span class="color1">{{ $artikel->kategori->nama_kategori }}</span>
                                            <h4><a href="{{ route('berita.show', $artikel->slug) }}">{{ $artikel->judul }}</a></h4>
                                            <p>{!! Str::words($artikel->konten, 10, '...') !!}</p>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <!-- Right content -->
                    <div class="col-lg-4">
                        @foreach($artikelsHighlight as $artikel)
                        <div class="trand-right-single d-flex">
                            <div class="trand-right-img">
                                <img src="{{ asset('storage/'. $artikel->media_utama) }}" alt="" style="width: 150px;">
                            </div>
                            <div class="trand-right-cap">
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
                                if ($currentPosts < $minimumPosts) {
                                    $index = 0;
                                    while (count($trendingLatestAll) < $minimumPosts) {
                                        $trendingLatestAll[] = $trendingLatestAll[$index];
                                        $index = ($index + 1) % $currentPosts;
                                    }
                                }
                            @endphp

                            @foreach($trendingLatestAll as $t)
                            <div class="weekly-single">
                                <div class="weekly-img">
                                    <img src="assets/img/news/weeklyNews2.jpg" alt="">
                                </div>
                                <div class="weekly-caption">
                                    <span class="color1">Strike</span>
                                    <h4><a href="#">{{$t->judul}}</a></h4>
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
                                if ($currentPosts < $minimumPosts) {
                                    $index = 0;
                                    while (count($allArticles) < $minimumPosts) {
                                        $allArticles[] = $highlightLatestAll[$index];
                                        $index = ($index + 1) % $currentPosts;
                                    }
                                }
                            @endphp

                            @foreach($allArticles as $t)
                            <div class="weekly2-single">
                                <div class="weekly2-img">
                                    <img src="assets/img/news/weekly2News1.jpg" alt="">
                                </div>
                                <div class="weekly2-caption">
                                    <span class="color1">Corporate</span>
                                    <p>25 Jan 2020</p>
                                    <h4><a href="#">{{$t->judul}}</a></h4>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Weekly2-News -->

    <!-- Start Pagination -->
    <div class="pagination-area pb-45 text-center">
        <div class="container">
            <div class="row">
                <div class="col-xl-12">
                    <div class="single-wrap d-flex justify-content-center">
                        <nav aria-label="Page navigation example">
                            <ul class="pagination justify-content-start">
                                <li class="page-item"><a class="page-link" href="#"><span class="flaticon-arrow roted"></span></a></li>
                                <li class="page-item active"><a class="page-link" href="#">01</a></li>
                                <li class="page-item"><a class="page-link" href="#">02</a></li>
                                <li class="page-item"><a class="page-link" href="#">03</a></li>
                                <li class="page-item"><a class="page-link" href="#"><span class="flaticon-arrow right-arrow"></span></a></li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Pagination -->
</main>

@endsection
