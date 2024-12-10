<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Profil Pengguna</title>
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

        .profile-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            align-items: flex-start;
            gap: 20px;
            margin-top: 100px;
            max-width: 900px;
            margin-left: auto;
            margin-right: auto;
            padding: 2rem;
            background-color: rgba(255, 255, 255, 0.85);
            border-radius: 12px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        .profile-picture-container {
            text-align: center;
            flex: 1;
        }

        .profile-picture {
            width: 150px;
            height: 150px;
            border-radius: 10px;
            object-fit: cover;
            border: 3px solid #007bff;
            margin-bottom: 10px;
        }

        .social-icons a {
            color: #007bff;
            font-size: 1.5rem;
            margin: 0 10px;
        }

        .social-icons a:hover {
            color: #0056b3;
        }

        .profile-info {
            flex: 2;
        }

        .btn-primary {
            background-color: #007bff;
            border: none;
        }

        .btn-primary:hover {
            background-color: #0056b3;
        }
    </style>
</head>

<body>

    <div class="profile-container">
        <!-- Foto Profil dan Media Sosial -->
        <div class="profile-picture-container">
            @if (Auth::user()->foto)
            <img src="{{ asset('storage/' . Auth::user()->foto) }}" alt="Foto Profil" class="profile-picture">
            @else
            <img src="https://via.placeholder.com/150" alt="Default Foto Profil" class="profile-picture">
            @endif
            <div class="social-icons mt-3">
                <!-- Facebook -->
                @if(!empty(Auth::user()->socialMedia->url_facebook))
                <a href="{{ Auth::user()->socialMedia->url_facebook }}" target="_blank" title="FB : {{ Auth::user()->socialMedia->username_facebook ?? 'Tidak tersedia' }}" data-bs-toggle="tooltip">
                    <i class="fab fa-facebook"></i>
                </a>
                @else
                <a title="URL Facebook tidak ditemukan" data-bs-toggle="tooltip">
                    <i class="text-primary fab fa-facebook"></i>
                </a>
                @endif

                <!-- Instagram -->
                @if(!empty(Auth::user()->socialMedia->url_instagram))
                <a href="{{ Auth::user()->socialMedia->url_instagram }}" target="_blank" title="IG : {{ Auth::user()->socialMedia->username_instagram ?? 'Tidak tersedia' }}" data-bs-toggle="tooltip">
                    <i class="fab fa-instagram"></i>
                </a>
                @else
                <a title="URL Instagram tidak ditemukan" data-bs-toggle="tooltip">
                    <i class="text-primary fab fa-instagram"></i>
                </a>
                @endif
            </div>
        </div>

        <!-- Informasi Profil -->
        <div class="profile-info">
            <form action="{{ route('pengguna.profile.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="mb-3 row">
                    <label for="nama" class="col-sm-3 col-form-label"><b>Nama:</b></label>
                    <div class="col-sm-9">
                        <input type="text" id="nama" name="nama" class="form-control" value="{{ Auth::user()->nama }}" readonly>
                    </div>
                </div>

                <div class="mb-3 row">
                    <label for="username" class="col-sm-3 col-form-label"><b>Username:</b></label>
                    <div class="col-sm-9">
                        <input type="text" id="username" name="username" class="form-control" value="{{ Auth::user()->username }}" readonly>
                    </div>
                </div>

                <div class="mb-3 row">
                    <label for="email" class="col-sm-3 col-form-label"><b>Email:</b></label>
                    <div class="col-sm-9">
                        <input type="email" id="email" name="email" class="form-control" value="{{ Auth::user()->email }}" readonly>
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
                        <textarea id="bio" name="bio" class="form-control" rows="4" readonly>{{ Auth::user()->bio }}</textarea>
                    </div>
                </div>

                <!-- Tombol Aksi -->
                <div class="d-flex justify-content-between mt-4">
                    <div class="text-center">
                        <button type="submit" class="btn btn-success me-2">Simpan</button>
                        <a href="{{ route('home') }}" class="btn btn-warning me-2">Kembali</a>
                        <a href="{{ route('pengguna.profile.edit') }}" class="btn btn-primary">Edit Profil</a>
                    </div>
                </div>
            </form>
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