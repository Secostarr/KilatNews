@extends('admin.layouts.app')
@section('title', 'Artikel')
@section('content')

<style>
    /* Styling the search container */
    .search-container {
        display: flex;
        align-items: center;
        position: relative;
        width: 40px;
        transition: width 0.4s;
    }

    /* Search input field */
    .search-input {
        opacity: 0;
        width: 0;
        padding: 0.5rem 1rem;
        border-radius: 20px;
        border: 1px solid #ced4da;
        outline: none;
        transition: width 0.4s, opacity 0.4s;
        position: absolute;
        left: 0;
    }

    /* Search icon */
    .search-icon {
        cursor: pointer;
        font-size: 20px;
        color: #333;
        transition: transform 0.4s;
    }

    /* Active state of input field */
    .search-container.active {
        width: 200px;
    }

    .search-container.active .search-input {
        width: 100%;
        opacity: 1;
    }

    .search-container.active .search-icon {
        transform: translateX(-32px);
    }
</style>

<div class="container-fluid pt-2 px-1">
    <div class="row bg-light rounded align-items-center mx-0 p-4">

        @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
        @endif

        <div class="d-flex justify-content-between align-items-center w-100">

            <div class="d-flex align-items-center gap-2">
                <i class="text-primary"></i>
                <h3 class="mb-0 text-dark mb-5">ARTIKEL</h3>
            </div>

            <a href="{{ Route('admin.artikel.berita.create') }}" class="btn btn-sm btn-primary d-flex align-items-center gap-2">
                <i class="fas fa-plus"></i>
                Tambah Artikel
            </a>
        </div>

        <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="pills-home-tab" data-bs-toggle="pill" data-bs-target="#pills-home" type="button" role="tab" aria-controls="pills-home" aria-selected="true"><i class="bi bi-eye-fill me-2"></i>Published</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="pills-profile-tab" data-bs-toggle="pill" data-bs-target="#pills-profile" type="button" role="tab" aria-controls="pills-profile" aria-selected="false"><i class="bi bi-archive-fill me-2"></i>Draft</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="pills-contact-tab" data-bs-toggle="pill" data-bs-target="#pills-contact" type="button" role="tab" aria-controls="pills-contact" aria-selected="false"><i class="bi bi-eye-slash-fill me-2"></i>Arcived</button>
            </li>
        </ul>

        <div class="container my-4 d-flex justify-content-end">
            <div class="search-container" onclick="activateSearch()">
                <input type="text" id="search-input" class="form-control search-input" placeholder="Cari...">
                <i class="fas fa-search search-icon"></i>
            </div>
        </div>

        <div class="tab-content" id="pills-tabContent">
            <!-- Tab Published -->
            <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                @foreach ($published as $artikel)
                <div class="row bg-white shadow-sm rounded p-4 mb-3 article-row">
                    <div class="col-md-3 col-12 mb-3 mb-md-0 d-flex justify-content-center align-items-center">
                        <img src="{{ asset('storage/' . $artikel->media_utama) }}" alt="Gambar Artikel" class="img-fluid rounded" style="max-height: 150px; width: auto;">
                    </div>
                    <div class="col-md-9 col-12">
                        <h5 class="fw-bold text-truncate" style="max-width: 100%;">{{ $artikel->judul }}</h5>
                        <p class="text-muted text-truncate">
                            {{ strip_tags($artikel->konten) }}
                        </p>
                        <div class="d-flex flex-wrap gap-2">
                            <a href="#" class="btn btn-info btn-sm">Detail</a>
                            <a href="{{ route('admin.artikel.berita.edit', $artikel->id_artikel) }}" class="btn btn-warning btn-sm">Edit</a>
                            <a href="{{ route('admin.artikel.berita.delete', $artikel->id_artikel) }}" onclick="return confirm('Yakin ingin menghapus artikel ini?')" class="btn btn-danger btn-sm">Hapus</a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

            <!-- Tab Draft -->
            <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                @foreach ($draft as $artikel)
                <div class="row bg-white shadow-sm rounded p-4 mb-3 article-row">
                    <!-- Konten Artikel Draft -->
                    <div class="col-md-3 col-12 mb-3 mb-md-0 d-flex justify-content-center align-items-center">
                        <img src="{{ asset('storage/' . $artikel->media_utama) }}" alt="Gambar Artikel" class="img-fluid rounded" style="max-height: 150px; width: auto;">
                    </div>
                    <div class="col-md-9 col-12">
                        <h5 class="fw-bold text-truncate" style="max-width: 100%;">{{ $artikel->judul }}</h5>
                        <p class="text-muted text-truncate">
                            {{ strip_tags($artikel->konten) }}
                        </p>
                        <div class="d-flex flex-wrap gap-2">
                            <a href="#" class="btn btn-info btn-sm">Detail</a>
                            <a href="{{ route('admin.artikel.berita.edit', $artikel->id_artikel) }}" class="btn btn-warning btn-sm">Edit</a>
                            <a href="{{ route('admin.artikel.berita.delete', $artikel->id_artikel) }}" onclick="return confirm('Yakin ingin menghapus artikel ini?')" class="btn btn-danger btn-sm">Hapus</a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

            <!-- Tab Archived -->
            <!-- Tab Archived -->
            <div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab">
                @foreach ($archived as $artikel)
                <div class="row bg-white shadow-sm rounded p-4 mb-3 article-row">
                    <!-- Konten Artikel Archived -->
                    <div class="col-md-3 col-12 mb-3 mb-md-0 d-flex justify-content-center align-items-center">
                        <img src="{{ asset('storage/' . $artikel->media_utama) }}" alt="Gambar Artikel" class="img-fluid rounded" style="max-height: 150px; width: auto;">
                    </div>
                    <div class="col-md-9 col-12">
                        <h5 class="fw-bold text-truncate" style="max-width: 100%;">{{ $artikel->judul }}</h5>
                        <p class="text-muted text-truncate">
                            {{ strip_tags($artikel->konten) }}
                        </p>
                        <div class="d-flex flex-wrap gap-2">
                            <a href="#" class="btn btn-info btn-sm">Detail</a>
                            <a href="{{ route('admin.artikel.berita.edit', $artikel->id_artikel) }}" class="btn btn-warning btn-sm">Edit</a>
                            <a href="{{ route('admin.artikel.berita.delete', $artikel->id_artikel) }}" onclick="return confirm('Yakin ingin menghapus artikel ini?')" class="btn btn-danger btn-sm">Hapus</a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

        </div>

    </div>

    <script>
        function activateSearch() {
            const container = document.querySelector('.search-container');
            container.classList.toggle('active');

            // Fokus pada input ketika aktif
            const input = document.querySelector('.search-input');
            if (container.classList.contains('active')) {
                input.focus();
            } else {
                input.blur();
            }
        }

        // Fungsi pencarian
        document.getElementById('search-input').addEventListener('input', function() {
            const filter = this.value.toLowerCase(); // Ubah input ke huruf kecil
            const articles = document.querySelectorAll('.article-row'); // Semua artikel di kedua tab

            articles.forEach(article => {
                const title = article.querySelector('h5').textContent.toLowerCase(); // Judul artikel
                const content = article.querySelector('p').textContent.toLowerCase(); // Konten artikel

                // Periksa apakah judul atau konten mengandung teks yang dicari
                if (title.includes(filter) || content.includes(filter)) {
                    article.style.display = ''; // Tampilkan artikel
                } else {
                    article.style.display = 'none'; // Sembunyikan artikel
                }
            });
        });

        // Log tab yang aktif (Opsional)
        document.querySelectorAll('[data-bs-toggle="pill"]').forEach(tab => {
            tab.addEventListener('shown.bs.tab', function(e) {
                console.log('Tab aktif:', e.target.id);
            });
        });
    </script>

    @endsection