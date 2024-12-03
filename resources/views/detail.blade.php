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
                            <img src="{{ asset('storage/' . $artikel->media_utama) }}" alt="{{ $artikel->judul }}">
                        </div>
                        <div class="section-tittle mb-30 pt-30">
                            <h3>{{ $artikel->judul }}</h3>
                        </div>
                        <div class="about-prea">
                            {{ strip_tags($artikel->konten) }}
                        </div>

                        <!-- Like Button -->
                        <form action="{{ route('like.article', $artikel->slug) }}" method="POST">
                            @csrf
                            <button class="btn btn-primary">
                                <span>{{ $artikel->like_count }}</span> 👍 Like
                            </button>
                        </form>

                        <!-- View Count -->
                        <div class="view-count">
                            <p>View: {{ $artikel->views }} </p>
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
                    <div class="section-tittle mb-40">
                        <h3>Follow Us</h3>
                    </div>
                    <!-- Social Links -->
                    <div class="single-follow mb-45">
                        <!-- Add your social media icons here -->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- About US End -->
</main>

@endsection