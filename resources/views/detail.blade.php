<!-- Artikel Utama -->
<div class="col-lg-8">
    <article class="single-article">
        <img src="{{ asset('storage/' . $artikel->media_utama) }}" alt="{{ $artikel->judul }}" class="img-fluid mb-3">
        <h1>{{ $artikel->judul }}</h1>
        <span class="badge badge-primary">{{ $artikel->kategori->nama_kategori }}</span>
        <p class="text-muted">{{ $artikel->created_at->format('d M Y') }}</p>
        <p class="text-muted">Views: {{ $artikel->view_count }}</p>
        <div class="article-content">
            {!! $artikel->konten !!}
        </div>
    </article>

    <!-- Tombol Like -->
    <div class="mt-3">
        <button class="like-btn" data-id="{{ $artikel->id_artikel }}">
            Like <span id="like-count">{{ $artikel->like_count }}</span>
        </button>
    </div>

    <!-- Form Komentar -->
    <div class="mt-5">
        <h4>Komentar</h4>
        @foreach($artikel->komentar as $komentar)
            <div class="comment mt-3">
                <strong>{{ $komentar->user->name }}</strong> - 
                <span class="text-muted">{{ $komentar->created_at->diffForHumans() }}</span>
                <p>{{ $komentar->komentar }}</p>
            </div>
        @endforeach

        @auth
        <form action="{{ route('artikel.komentar', $artikel->id) }}" method="POST">
            @csrf
            <textarea name="komentar" rows="3" class="form-control" placeholder="Tambahkan komentar..."></textarea>
            <button type="submit" class="btn btn-primary mt-2">Kirim</button>
        </form>
        @else
            <p class="text-muted mt-3">Silakan <a href="{{ route('login') }}">login</a> untuk berkomentar.</p>
        @endauth
    </div>
</div>
