@extends('layouts.app')
@section('title', 'Home')
@section('konten')

<main>
    <!-- Start Latest News -->
    <div class="latest-news">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="trending-tittle">
                        <strong>Latest News</strong>
                    </div>
                </div>
            </div>
            <div class="row">
                @if($latest_news->isEmpty())
                    <div class="col-12">
                        <p>No news available from the last 5 days.</p>
                    </div>
                @else
                    @foreach($latest_news as $news)
                        <div class="col-lg-4 col-md-6 mb-4">
                            <div class="single-news">
                                <div class="news-img">
                                    <img src="{{ asset('storage/' . $news->media_utama) }}" alt="{{ $news->judul }}" class="img-fluid" style="width: 200px; height: 200px; object-fit: cover;">
                                </div>
                                <div class="news-content">
                                    <h4><a href="{{ route('berita.show', $news->slug) }}">{{ $news->judul }}</a></h4>
                                    <p>{{ Str::limit(strip_tags($news->konten), 50) }}</p>
                                    <span class="news-date">{{ $news->created_at->format('d M Y') }}</span>
                                </div>
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
