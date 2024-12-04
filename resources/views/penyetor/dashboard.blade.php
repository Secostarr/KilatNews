<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>

<body>
    <div class="container mt-4">
        <!-- Header -->

        <!-- Content Section -->
        <div class="row mb-4 mt-5">
            <!-- Left Image -->
            <div class="col-md-4 d-flex justify-content-center align-items-center" style="height: 200px;">
                <img src="{{ $user->foto ? asset('storage/' . $user->foto) : asset('images/profil.jpeg') }}" alt="Gambar" style="max-height: 100%; max-width: 100%;">
            </div>
            <!-- Right Inputs -->
            <div class="col-md-8">
                <div class="mb-2">
                    <div class="d-flex align-items-center mb-3">
                        <a href="{{ Route('home') }}" class="btn btn-outline-secondary me-3">
                            <i class="fas fa-arrow-left"></i>
                        </a>
                        <h2 class="m-0">Halaman Dashboard Contributor</h2>
                    </div>
                </div>
                <div class="mb-2">
                    <label for="title" class="form-label">Nama Contributor</label>
                    <input type="text" id="title" class="form-control" value="{{ ($user->nama) }}" disabled>
                </div>
                <div class="mb-2">
                    <label for="description" class="form-label">Bio Contributor</label>
                    <textarea id="description" class="form-control" rows="3" disabled>{{ Auth::user()->bio ? Auth::user()->bio : 'Anda belum menambahkan bio' }}</textarea>
                </div>
                <div class="mb-2">
                    <a href="{{ Route('user.profile') }}" class="btn btn-primary">Info Profile Saya</a>
                </div>
            </div>
        </div>

        <!-- Statistics Section -->
        <div class="row text-center mb-4">
            <h3 class="text-secondary">Like komentar dan view yang sudah di dapat</h3>
            <div class="col-md-4">
                <div class="bg-light p-4 rounded">
                    <i class="fas fa-thumbs-up text-primary fa-2x"></i>
                    <h5 class="mt-2">Like: {{ $totalLikes }}</h5>
                </div>
            </div>
            <div class="col-md-4">
                <div class="bg-light p-4 rounded">
                    <i class="fas fa-comments text-success fa-2x"></i>
                    <h5 class="mt-2">Komentar: {{ $totalComments }}</h5>
                </div>
            </div>
            <div class="col-md-4">
                <div class="bg-light p-4 rounded">
                    <i class="fas fa-eye text-primary fa-2x"></i>
                    <h5 class="mt-2">View: {{ $totalViews }}</h5>
                </div>
            </div>
        </div>


        <!-- Article Content Section -->
        <div class="bg-light p-4 rounded">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h3>Konten Artikel {{ Auth::user()->nama }}</h3>
                <a href="{{ Route('contributor.dashboard.create') }}" class="btn btn-secondary">+ Tambah Artikel</a>
            </div>
            @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
            @endif
            <!-- Isi dari konten yang contributor tambahkan -->
            <div class="container-fluid">
                <div class="row g-4">
                    @foreach ($articles as $artikel)
                    <div class="col-md-4 col-12 mb-4 d-flex justify-content-center align-items-start">
                        <div class="card shadow-sm border-0 rounded-lg overflow-hidden">
                            <!-- Gambar Artikel -->
                            <div class="card-img-top">
                                <img src="{{ asset('storage/' . $artikel->media_utama) }}" alt="Gambar Artikel" class="img-fluid rounded-top" style="max-height: 200px; width: 100%; object-fit: cover;">
                            </div>
                            <div class="card-body">
                                <h5 class="fw-bold text-truncate" style="max-width: 100%;">{{ $artikel->judul }}</h5>
                                <p class="text-muted text-truncate" style="max-width: 100%;">konten : {{ strip_tags($artikel->konten) }}</p>
                                <p class="text-muted">
                                    @php
                                    $formattedDate = \Carbon\Carbon::parse($artikel->tanggal_publikasi)->locale('id')->isoFormat('D MMMM YYYY');
                                    @endphp
                                    Tanggal: {{ $formattedDate }}
                                </p>
                                <div class="d-flex flex-wrap gap-2 mt-3">
                                    <a href="{{ route('berita.show', $artikel->slug) }}" class="btn btn-success btn-sm">Lihat pada halaman</a>
                                    <a href="{{ route('contributor.dashboard.edit', $artikel->id_artikel) }}" class="btn btn-warning btn-sm">Edit</a>
                                    <form action="{{ route('contributor.dashboard.delete', $artikel->id_artikel) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus artikel ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                                    </form>

                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>