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
                    <label for="description" class="form-label"></label>
                    <textarea id="description" class="form-control" rows="3" disabled>{{ Auth::user()->bio ? Auth::user()->bio : 'Anda belum menambahkan bio' }}</textarea>
                </div>
            </div>
        </div>

        <!-- Statistics Section -->
        <div class="row text-center mb-4">
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
                    <i class="fas fa-eye text-info fa-2x"></i>
                    <h5 class="mt-2">View: {{ $totalViews }}</h5>
                </div>
            </div>
        </div>


        <!-- Article Content Section -->
        <div class="bg-light p-4 rounded">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h3>Konten Artikel Saya</h3>
                <a href="" class="btn btn-secondary">+ Tambah Artikel</a>
            </div>
            <!-- Isi dari konten yang contributor tambahkan -->
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>