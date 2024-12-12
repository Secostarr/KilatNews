<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Pendaftaran Instansi</title>
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <style>
        body {
            background-image: url('../images/bg_berita.jpg');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            background-attachment: fixed;
        }

        .card {
            background-color: rgba(255, 255, 255, 0.8);
            /* Transparan putih */
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        .card-header {
            background-color: rgba(40, 167, 69, 0.9);
            /* Hijau dengan transparansi */
        }

        .form-control {
            background-color: rgba(255, 255, 255, 0.6);
            /* Transparan untuk input */
            border: 1px solid rgba(0, 0, 0, 0.2);
        }

        .form-control:focus {
            background-color: rgba(255, 255, 255, 0.9);
            /* Fokus lebih solid */
            box-shadow: 0 0 5px rgba(40, 167, 69, 0.5);
        }
    </style>
</head>

<body>
    <div class="container my-5">
        <div class="row justify-content-center">
            <div class="col-sm-9 mt-5">

                <div class="card shadow-sm">
                    <div class="card-header text-white text-center">
                        <h3 class="mb-0">Form Pendaftaran Contributor</h3>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('pendaftaran.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label for="namaInstansi" class="form-label">Nama</label>
                                <input class="form-control" id="" value="{{ Auth::user()->nama }}" disabled>
                                @error('nama')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Username</label>
                                <input class="form-control" id="" value="{{ Auth::user()->username }}" disabled>
                                @error('username')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="keterangan" class="form-label">keterangan</label>
                                <textarea class="form-control" id="keterangan" name="keterangan" rows="3" placeholder="Masukkan keterangan anda kenapa ingin mendaftar" required></textarea>
                                @error('keterangan')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="nomor_telfon" class="form-label">Nomor Telepon</label>
                                <input type="text" class="form-control" id="nomor_telfon" name="no_telfon" placeholder="Masukkan nomor telepon yang bisa di hubungi" required>
                                @error('no_telfon')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="d-grid mt-5">
                                <button type="submit" class="btn btn-success">Daftar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>