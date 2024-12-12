@extends('layouts.app')
@section('title', 'Artikel') <!-- Set the page title dynamically -->
@section('konten')
<style>
    .about-prea img {
        max-width: 100%;
        /* Gambar tidak akan lebih lebar dari elemen kontainernya */
        height: auto;
        /* Menjaga rasio aspek gambar */
        display: block;
        /* Mencegah margin di bawah gambar */
        margin: 10px auto;
        /* Tambahkan margin opsional */
    }
</style>

<main>
    <!-- About US Start -->
    <div class="trending-area fix">
        <div class="container">
            <div class="trending-main">
                <br>
                <div class="row">
                    <div class="col-lg-8">
                        <div class="trending-top mb-30">
                            <div class="trend-top-img">
                                <img src="{{ asset('storage/' . $artikel->media_utama) }}" alt="{{ $artikel->judul }}">
                            </div>

                            <div class="section-tittle mb-30 pt-30">
                                <h3 class="m-0">{{ $artikel->judul }}</h3>
                                <span class="badge bg-info text-white" style="font-weight: 600;">
                                    <i class="fas fa-calendar-alt"></i>
                                    {{ \Carbon\Carbon::parse($artikel->tanggal_publikasi)->isoFormat('D MMMM YYYY') }}
                                </span>
                            </div>

                            <div class="about-prea">
                                {!! $artikel->konten !!}
                            </div>

                            <h3 class="text-secondary m-0">Lokasi Berita:</h3>
                            <p class="text-dark">{{ $artikel->lokasi ?? 'Lokasi tidak tersedia' }}</p>

                            <!-- View Count -->
                            <div class="view-count">
                                <p>View: {{ $artikel->viewer_count }} </p>
                            </div>

                            <div id="disqus_thread"></div>
                            <script>
                                /**
                                 *  RECOMMENDED CONFIGURATION VARIABLES: EDIT AND UNCOMMENT THE SECTION BELOW TO INSERT DYNAMIC VALUES FROM YOUR PLATFORM OR CMS.
                                 *  LEARN WHY DEFINING THESE VARIABLES IS IMPORTANT: https://disqus.com/admin/universalcode/#configuration-variables    */
                                /*
                                var disqus_config = function () {
                                this.page.url = PAGE_URL;  // Replace PAGE_URL with your page's canonical URL variable
                                this.page.identifier = PAGE_IDENTIFIER; // Replace PAGE_IDENTIFIER with your page's unique identifier variable
                                };
                                */
                                (function() { // DON'T EDIT BELOW THIS LINE
                                    var d = document,
                                        s = d.createElement('script');
                                    s.src = 'https://kilatnews.disqus.com/embed.js';
                                    s.setAttribute('data-timestamp', +new Date());
                                    (d.head || d.body).appendChild(s);
                                })();
                            </script>
                            <noscript>Please enable JavaScript to view the <a href="https://disqus.com/?ref_noscript">comments powered by Disqus.</a></noscript>
                        </div>
                    </div>

                    <div class="col-lg-4">
                        @foreach($relatedArtikelsten as $artikel)
                        <div class="trand-right-single d-flex">
                            <div class="trand-right-img">
                                <img src="{{ asset('storage/'. $artikel->media_utama) }}" alt="" style="width: 150px; height: 150px; object-fit: cover;">
                            </div>
                            <div class="trand-right-cap mx-3">
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
    <!-- About US End -->
</main>

@endsection