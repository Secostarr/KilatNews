<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <style>
        body {
            background-image: url('../images/bg_berita.jpg');
            /* Ganti dengan path gambar Anda */
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            background-attachment: fixed;
        }

        .login {
            margin-top: 100px;
        }

        .card {
            border-radius: 12px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            background-color: rgba(255, 255, 255, 0.7);
            /* Transparan dengan opacity 0.7 */
        }

        .card-body {
            padding: 2rem;
        }

        .form-label {
            font-weight: bold;
        }

        .btn-primary {
            background-color: #007bff;
            border: none;
        }

        .btn-primary:hover {
            background-color: #0056b3;
        }

        .btn-link {
            color: #007bff;
        }

        .btn-link:hover {
            color: #0056b3;
            text-decoration: underline;
        }

        .img-animated {
            margin-top: 1rem;
            animation: rotate 5s infinite linear;
            transform-style: preserve-3d;
        }

        @keyframes rotate {
            from {
                transform: rotateY(-30deg);
            }

            to {
                transform: rotateY(30deg);
            }
        }

        .password-options {
            margin-top: 0.5rem;
            /* Reduce top margin */
            margin-bottom: 0;
            /* Remove bottom margin */
            display: flex;
            align-items: center;
        }

        .form-check-label {
            margin-bottom: 0;
            /* Remove bottom margin from label */
        }
    </style>
</head>

<body>
    <div class="login">
        <div class="row justify-content-center">
            <div class="col-md-4">
                <h3 class="text-center text-light mb-3"><b>User Register <b class="text-warning">KilatNews</b></b></h3>
                <p class="text-center text-light mb-4">Silahkan Masukkan Data Anda</p>

                <div class="card">

                    <div class="card-body">
                        @if ($errors->has('login_error'))
                        <div class="alert alert-danger">
                            {{ $errors->first('login_error') }}
                        </div>
                        @endif

                        @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                        @endif

                        <form action="" method="post">
                            @csrf
                            <div class="mb-3">
                                <label for="nama" class="form-label">Nama:</label>
                                <input type="text" name="nama" id="nama" class="form-control" placeholder="Masukkan nama anda" value="{{ old('username') }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="username" class="form-label">Username:</label>
                                <input type="text" name="username" id="username" class="form-control" placeholder="Masukkan username anda" value="{{ old('username') }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email:</label>
                                <input type="text" name="email" id="email" class="form-control" placeholder="Masukkan email anda" value="{{ old('username') }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Password:</label>
                                <input type="password" name="password" id="password" class="form-control" placeholder="Masukkan password anda" required>
                            </div>
                            <div class="mb-3 password-options">
                                <input type="checkbox" id="showPassword" class="form-check-input me-2">
                                <label for="showPassword" class="form-check-label"><b>Show Password</b></label>
                            </div>
                            <button type="submit" class="btn btn-primary w-100">Sign In</button>
                            <p class="mt-1">Sudah Memiliki Akun ? <a href="{{ Route('user.login') }}">Login</a></p>
                            <div class="text-center">
                                <div class="row justify-content-center">
                                    <h5 class="img-animated" alt="Animated 3D Image">KilatNews</h5>
                                </div>
                            </div>
                        </form>
                    </div>  
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    <script>
        document.getElementById('showPassword').addEventListener('change', function() {
            var passwordField = document.getElementById('password');
            if (this.checked) {
                passwordField.type = 'text';
            } else {
                passwordField.type = 'password';
            }
        });
    </script>
</body>

</html>