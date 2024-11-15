<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Edit Profil</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
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
                @if ($pengguna->foto)
                <img src="{{ asset('storage/' . $pengguna->foto) }}" alt="Foto Profil" class="profile-picture mb-3">
                @else
                <img src="https://via.placeholder.com/150" alt="Default Foto Profil" class="profile-picture mb-3">
                @endif
            </div>

            <!-- Formulir Edit Profil -->
            <form action="" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="mb-3 row">
                    <label for="nama" class="col-sm-3 col-form-label"><b>Nama:</b></label>
                    <div class="col-sm-9">
                        <input type="text" id="nama" name="nama" class="form-control" value="{{ $pengguna->nama }}" required>
                    </div>
                </div>

                <div class="mb-3 row">
                    <label for="username" class="col-sm-3 col-form-label"><b>Username:</b></label>
                    <div class="col-sm-9">
                        <input type="text" id="username" name="username" class="form-control" value="{{ $pengguna->username }}" required>
                    </div>
                </div>

                <div class="mb-3 row">
                    <label for="password" class="col-sm-3 col-form-label"><b>Password:</b></label>
                    <div class="col-sm-9">
                        <input type="password" id="password" class="form-control" require>
                    </div>
                </div>

                <div class="mb-3 row">
                    <label for="email" class="col-sm-3 col-form-label"><b>Email:</b></label>
                    <div class="col-sm-9">
                        <input type="email" id="email" name="email" class="form-control" value="{{ $pengguna->email }}" required>
                    </div>
                </div>

                <div class="mb-3 row">
                    <label for="bio" class="col-sm-3 col-form-label"><b>Bio:</b></label>
                    <div class="col-sm-9">
                        <textarea id="bio" name="bio" class="form-control" rows="4">{{ $pengguna->bio }}</textarea>
                    </div>
                </div>

                <div class="mb-3 row">
                    <label for="foto" class="col-sm-3 col-form-label"><b>Foto Profil:</b></label>
                    <div class="col-sm-9">
                        <input type="file" id="foto" name="foto" class="form-control">
                    </div>
                </div>

                <!-- Tombol Aksi -->
                <div class="text-center mt-4">
                <button type="submit" class="btn btn-primary me-2">Simpan</button>
                <a href="{{ route('home') }}" class="btn btn-warning">Kembali</a>
                </div>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
