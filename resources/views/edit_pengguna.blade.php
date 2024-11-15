<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Edit Pengguna</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        body {
            background-image: url('../images/bg_berita.jpg');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            background-attachment: fixed;
        }

        .profile {
            margin-top: 100px;
        }

        .card {
            border-radius: 12px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            background-color: rgba(255, 255, 255, 0.85);
            padding: 2rem;
            max-width: 800px;
            margin: auto;
        }

        .profile-picture {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            object-fit: cover;
            border: 3px solid #007bff;
        }

        .btn-primary {
            background-color: #007bff;
            border: none;
        }

        .btn-primary:hover {
            background-color: #0056b3;
        }

        .social-icons a {
            color: #007bff;
            font-size: 1.5rem;
            margin: 0 10px;
        }

        .social-icons a:hover {
            color: #0056b3;
        }
    </style>
</head>

<body>

    <div class="profile">
        <div class="card">
            <div class="text-center mb-4">
                <!-- Foto Profil -->
                @if (Auth::user()->foto)
                <img src="{{ asset('storage/' . Auth::user()->foto) }}" alt="Foto Profil" class="profile-picture mb-3">
                @else
                <img src="https://via.placeholder.com/150" alt="Default Foto Profil" class="profile-picture mb-3">
                @endif
            </div>

            <!-- Informasi Profil -->
            <form action="" method="post" enctype="multipart/form-data">
                <div class="mb-3 row">
                    <label for="nama" class="col-sm-3 col-form-label"><b>Nama:</b></label>
                    <div class="col-sm-9">
                        <input type="text" id="nama" class="form-control" value="{{ Auth::user()->nama }}" readonly>
                    </div>
                </div>

                <div class="mb-3 row">
                    <label for="username" class="col-sm-3 col-form-label"><b>Username:</b></label>
                    <div class="col-sm-9">
                        <input type="text" id="username" class="form-control" value="{{ Auth::user()->username }}" readonly>
                    </div>
                </div>

                <div class="mb-3 row">
                    <label for="role" class="col-sm-3 col-form-label"><b>Role:</b></label>
                    <div class="col-sm-9">
                        <input type="text" id="role" class="form-control" value="{{ Auth::user()->role }}" readonly>
                    </div>
                </div>

                <div class="mb-3 row">
                    <label for="bio" class="col-sm-3 col-form-label"><b>Bio:</b></label>
                    <div class="col-sm-9">
                        <textarea id="bio" class="form-control" rows="4" readonly>{{ Auth::user()->bio ?? 'bio anda masih kosong' }}</textarea>
                    </div>
                </div>

                <!-- Tombol Aksi -->
                <div class="text-center mt-4">
                    <a href="{{ route('pengguna.update') }}" class="btn btn-primary me-2">Simpan</a>
                    <a href="{{ route('home') }}" class="btn btn-warning">Kembali</a>
                </div>
            </form>

            <!-- Ikon Media Sosial -->
            <div class="text-center mt-4 social-icons">
                <a href="https://www.facebook.com/yourprofile" target="_blank" title="Facebook" data-bs-toggle="tooltip"><i class="fab fa-facebook"></i></a>
                <a href="https://www.instagram.com/yourprofile" target="_blank" title="Instagram" data-bs-toggle="tooltip"><i class="fab fa-instagram"></i></a>
                <a href="https://www.instagram.com/yourprofile" target="_blank" title="{{ Auth::user()->email }}" data-bs-toggle="tooltip"><i class="fab fa-google"></i></a>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>

    <script>
        // Inisialisasi tooltip Bootstrap
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
        var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl);
        });
    </script>
</body>
</html>