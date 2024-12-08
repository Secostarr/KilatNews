@extends('layouts.app')
@section('title', 'Artikel') <!-- Set the page title dynamically -->
@section('konten')
<main>
    <!-- About US Start -->
    <div class="about-area">
        <div class="container">
            <!-- Hot Aimated News Tittle-->
            <div class="row">
                <div class="col-lg-12">
                    <div class="trending-tittle">
                        <strong>Trending now</strong>
                        <div class="trending-animated">
                            <ul id="js-news" class="js-hidden">
                                <li class="news-item">Bangladesh dolor sit amet, consectetur adipisicing elit.</li>
                                <li class="news-item">Spondon IT sit amet, consectetur.......</li>
                                <li class="news-item">Rem ipsum dolor sit amet, consectetur adipisicing elit.</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-8">
                    <div class="about-right mb-90">
                        <div class="about-img">
                            <img src="{{ asset('storage/' . $artikel->media_utama) }}" alt="{{ $artikel->judul }}" >
                        </div>
                        <div class="section-tittle mb-30 pt-30">
                            <h3>{{ $artikel->judul }}</h3>
                        </div>
                        <div class="about-prea">
                            {{ strip_tags($artikel->konten) }}
                        </div>

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
    <!-- About US End -->
</main>

@endsection