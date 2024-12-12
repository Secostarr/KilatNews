@extends('layouts.app')
@section('title', 'Category')
@section('konten')
<style>
    .color1 {
        color: #000;
        text-transform: uppercase;
        font-size: 11px;
        font-weight: 400;
        padding: 10px 15px;
        line-height: 1;
        margin-bottom: 15px;
        display: inline-block;
    }

    a:hover {
        color: inherit;
    }
</style>
<main>
    <!-- Whats New Start -->
    <section class="whats-news-area pt-50 pb-20">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="row d-flex justify-content-between">
                        <div class="col-lg-3 col-md-3">
                            <div class="section-tittle mb-30">
                                <h3>Whats New</h3>
                            </div>
                        </div>
                        <div class="properties__button" style="width: 100%;">
                            <!--Nav Button  -->
                            <nav>
                                <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                    <a class="nav-item nav-link {{ request()->routeIs('categori') && !request()->is('categori/*') ? 'active' : '' }}" id="nav-home-tab" href="{{ route('categori') }}" role="tab">
                                        All
                                    </a>

                                    @foreach($categoris as $categori)
                                    <!-- Cek apakah kita berada di kategori spesifik -->
                                    <a class="nav-item nav-link {{ request()->is('categori/' . $categori->slug) ? 'active' : '' }}" id="nav-{{ $categori->id }}-tab" href="{{ route('categori', $categori->slug) }}" role="tab">
                                        {{ $categori->nama_kategori }}
                                    </a>
                                    @endforeach
                                </div>
                            </nav>
                            <!--End Nav Button  -->
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="tab-content" id="nav-tabContent">
                                <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                                    <div class="whats-news-caption">
                                        <div class="row">
                                            @if($artikels->isEmpty())
                                            <p>No articles available in this category.</p>
                                            @else
                                            @foreach($artikels as $artikel)
                                            <div class="col-lg-3">
                                                <div class="trend-bottom-img mb-30">
                                                    <img src="{{ asset('storage/' . $artikel->media_utama) }}" alt="{{ $artikel->judul }}" style="width: 150px; height: 150px; object-fit: cover;">
                                                </div>
                                                <div class="trend-bottom-cap">
                                                    <span class="color1">{{ $artikel->kategori->nama_kategori }}</span>
                                                    <h4><a href="{{ route('berita.show', $artikel->slug) }}">{{ $artikel->judul }}</a></h4>
                                                    <p>{{ Str::limit(strip_tags($artikel->konten), 100) }}</p>
                                                </div>
                                            </div>
                                            @endforeach
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End Nav Card -->
                </div>
            </div>
        </div>
    </section>
</main>

@endsection