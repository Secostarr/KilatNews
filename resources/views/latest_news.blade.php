@extends('layouts.app')
@section('title', 'Latest News')
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
    <!-- Start Latest News -->
    <div class="latest-news pt-20 pb-20">
        <div class="container">
            <div class="row">
                @if($latest_news->isEmpty())
                <div class="col-12">
                    <p>No news available from the last 5 days.</p>
                </div>
                @else
                @foreach($latest_news as $news)
                <div class="col-lg-3">
                    <div class="trend-bottom-img mb-30">
                        <img src="{{ asset('storage/' . $news->media_utama) }}" alt="{{ $news->judul }}" style="width: 150px; height: 150px; object-fit: cover;">
                    </div>
                    <div class="trend-bottom-cap">
                        <span class="color1">{{ $news->kategori->nama_kategori }}</span>
                        <h4><a href="{{ route('berita.show', $news->slug) }}">{{ $news->judul }}</a></h4>
                        <p>{{ Str::limit(strip_tags($news->konten), 100) }}</p>
                        <span class="news-date">{{ $news->created_at->format('d M Y') }}</span>
                    </div>
                </div>
                @endforeach
                @endif
            </div>
        </div>
    </div>
    <!-- Latest News End -->
</main>

@endsection