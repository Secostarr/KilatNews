<!doctype html>
<html class="no-js" lang="zxx">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>KilatNews - @yield('title') </title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="manifest" href="{{ asset('site.webmanifest')}}">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('assets/img/favicon.ico')}}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <!-- jQuery -->
    <script src="{{ asset('assets/js/vendor/jquery-1.12.4.min.js') }}"></script>

    <!-- CSS here -->
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{ asset('assets/css/owl.carousel.min.css')}}">
    <link rel="stylesheet" href="{{ asset('assets/css/ticker-style.css')}}">
    <link rel="stylesheet" href="{{ asset('assets/css/flaticon.css')}}">
    <link rel="stylesheet" href="{{ asset('assets/css/slicknav.css')}}">
    <link rel="stylesheet" href="{{ asset('assets/css/animate.min.css')}}">
    <link rel="stylesheet" href="{{ asset('assets/css/magnific-popup.css')}}">
    <link rel="stylesheet" href="{{ asset('assets/css/fontawesome-all.min.css')}}">
    <link rel="stylesheet" href="{{ asset('assets/css/themify-icons.css')}}">
    <link rel="stylesheet" href="{{ asset('assets/css/slick.css')}}">
    <link rel="stylesheet" href="{{ asset('assets/css/nice-select.css')}}">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css')}}">
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.3/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet@1.9.3/dist/leaflet.js"></script>

</head>

<body>

    <!-- Preloader Start -->
    <div id="preloader-active">
        <div class="preloader d-flex align-items-center justify-content-center">
            <div class="preloader-inner position-relative">
                <div class="preloader-circle"></div>
                <div class="preloader-img pere-text">
                    <img src="{{ asset('img/logokilat.jpg') }}  " alt="">
                </div>
            </div>
        </div>
    </div>
    <!-- Preloader Start -->

    <header>
        <!-- Header Start -->
        <div class="header-area">
            <div class="main-header ">
                <div class="header-top black-bg d-none d-md-block">
                    <div class="container">
                        <div class="col-xl-12">
                            <div class="row d-flex justify-content-between align-items-center">
                                <div class="header-info-left">
                                    <ul>
                                        <li><img src="assets/img/icon/header_icon1.png" alt="" id="weather-icon"> <span id="weather-info"></span></li>
                                        <li><img src="assets/img/icon/header_icon1.png" alt=""> <span id="date-info"></span></li>
                                    </ul>
                                </div>
                                <div class="header-info-right">
                                    <ul class="header-social">
                                        @if (Auth::user())
                                        <li>
                                            <div class="nav-item dropdown">
                                                <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown" role="button" aria-expanded="false">
                                                    <i class="fas fa-user ms-0"></i>
                                                    {{ Auth::user()->nama }}
                                                </a>
                                                <ul class="dropdown-menu dropdown-menu-end shadow-sm border-0 rounded m-0">
                                                    @if(Au-th::user()->role === 'admin')
                                                    <li><a href="{{ Route('admin.profile') }}" class="dropdown-item text-dark custom-hover">My Profile</a></li>
                                                    @elseif(Auth::user()->role === 'user' || 'contributor')
                                                    <li><a href="{{ Route('user.profile') }}" class="dropdown-item text-dark custom-hover">My Profile</a></li>
                                                    @endif
                                                    @php
                                                    // Periksa apakah pengguna sudah mendaftar
                                                    $sudahMendaftar = \App\Models\Pendaftaran::where('id_user', Auth::user()->id_user)->exists();
                                                    @endphp
                                                    @if (Auth::user()->role === 'contributor')
                                                    <!-- Jika role adalah contributor -->
                                                    <li><a href="{{ Route('contributor.dashboard') }}" class="dropdown-item text-dark custom-hover">Dashboard Saya</a></li>
                                                    @elseif (!$sudahMendaftar)
                                                    <!-- Jika pengguna belum mendaftar -->
                                                    <li><a href="{{ Route('pendaftaran') }}" class="dropdown-item text-dark custom-hover">Daftar Contributor</a></li>
                                                    @else
                                                    <!-- Jika pengguna sudah mendaftar tetapi belum menjadi contributor -->
                                                    <li><a href="#" class="dropdown-item text-dark custom-hover">Sudah Mendaftar</a></li>
                                                    @endif

                                                    @if(Auth::user()->role === 'admin')
                                                    <li><a href="{{ route('admin.logout') }}" class="dropdown-item text-dark custom-hover">Log Out</a></li>
                                                    @elseif(Auth::user()->role === 'user' || 'contributor')
                                                    <li><a href="{{ route('pengguna.logout') }}" class="dropdown-item text-dark custom-hover">Log Out</a></li>
                                                    @endif
                                                </ul>
                                            </div>
                                            <style>
                                                .custom-hover {
                                                    transition: color 0.3s ease;
                                                }

                                                .custom-hover:hover {
                                                    color: orange;
                                                }

                                                .dropdown-menu {
                                                    min-width: 100%;
                                                }
                                            </style>
                                        </li>
                                        @else
                                        <li>
                                            <a href="{{ Route('user.login') }}"><i class="fas fa-user"></i>
                                                Login
                                            </a>
                                        </li>
                                        @endif
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="header-mid d-none d-md-block">
                    <div class="container">
                        <div class="row d-flex align-items-center">
                            <!-- Logo -->
                            <div class="col-xl-3 col-lg-3 col-md-3 pt-0 pb-0">
                                <div class="logo d-flex align-items-center">
                                    <a href="index.html"><img src="{{ asset('img/logokilat.jpg') }}" width="200" alt=""></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="header-bottom header-sticky">
                    <div class="container">
                        <div class="row align-items-center">
                            <div class="col-xl-10 col-lg-10 col-md-12 header-flex">
                                <!-- sticky -->
                                <div class="sticky-logo">
                                    <a href="index.html"><img src="{{ asset('img/logokilat.jpg') }}" width="200" alt=""></a>
                                </div>
                                <!-- Main-menu -->
                                <div class="main-menu d-none d-md-block">
                                    <nav>
                                        <ul id="navigation">
                                            <li><a href="{{ route('home') }}">Home</a></li>
                                            <li><a href="{{ route('categori') }}">Category</a></li>
                                            <li><a href="{{ route('latest_news') }}">Latest News</a></li>
                                            <li><a href="{{ route('contact') }}">Contact</a></li>
                                            <li><a href="#">Daerah</a>
                                                <ul class="submenu">
                                                    <li><a href="{{ route('home', 'lampung-timur') }}">Lampung Timur</a></li>
                                                    <li><a href="{{ route('home', 'lampung-selatan') }}">Lampung Selatan</a></li>
                                                    <li><a href="{{ route('home', 'metro') }}">Metro</a></li>
                                                    <li><a href="{{ route('home', 'lampung-tengah') }}">Lampung Tengah</a></li>
                                                </ul>
                                            </li>
                                        </ul>
                                    </nav>
                                </div>
                            </div>
                            <div class="col-xl-2 col-lg-2 col-md-4">
                                <div class="header-right-btn f-right d-none d-lg-block">
                                    <i class="fas fa-search special-tag"></i>
                                    <div class="search-box">
                                        <form action="#">
                                            <input type="text" placeholder="Search">

                                        </form>
                                    </div>
                                </div>
                            </div>
                            <!-- Mobile Menu -->
                            <div class="col-12">
                                <div class="mobile_menu d-block d-md-none"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Header End -->
    </header>

    <!-- Navbar -->
    @yield('navbar')

    @yield('konten')

    <footer class="bg-dark text-white pt-4">
        <div class="container">
            <div class="row">
                <!-- Section 1 -->
                <div class="col-md-3">
                    <h6 class="text-uppercase text-white fw-bold">Company Name</h6>
                    <hr class="mb-4 mt-0" style="width: 60px; background-color: #7c4dff; height: 2px;">
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
                </div>

                <!-- Section 2 -->
                <div class="col-md-3">
                    <h6 class="text-uppercase text-white fw-bold">Products</h6>
                    <hr class="mb-4 mt-0" style="width: 60px; background-color: #7c4dff; height: 2px;">
                    <ul class="list-unstyled">
                        <li><a href="#!" class="text-white">MDBootstrap</a></li>
                        <li><a href="#!" class="text-white">MDWordPress</a></li>
                        <li><a href="#!" class="text-white">BrandFlow</a></li>
                        <li><a href="#!" class="text-white">Bootstrap Angular</a></li>
                    </ul>
                </div>

                <!-- Section 3 -->
                <div class="col-md-3">
                    <h6 class="text-uppercase text-white fw-bold">Useful Links</h6>
                    <hr class="mb-4 mt-0" style="width: 60px; background-color: #7c4dff; height: 2px;">
                    <ul class="list-unstyled">
                        <li><a href="#!" class="text-white">Your Account</a></li>
                        <li><a href="#!" class="text-white">Affiliate</a></li>
                        <li><a href="#!" class="text-white">Shipping Rates</a></li>
                        <li><a href="#!" class="text-white">Help</a></li>
                    </ul>
                </div>

                <!-- Section 4 -->
                <div class="col-md-3">
                    <h6 class="text-uppercase text-white fw-bold">Contact</h6>
                    <hr class="mb-4 mt-0" style="width: 60px; background-color: #7c4dff; height: 2px;">
                    <p><i class="fas fa-home"></i></p>
                    <p><i class="fas fa-envelope"></i></p>
                    <p><i class="fas fa-phone"></i></p>
                </div>
            </div>
        </div>

        <!-- Copyright -->
        <div class="text-center py-3" style="background-color: rgba(0, 0, 0, 0.2);">
            © 2024 Copyright: <a class="text-white" href="https://example.com/">KilatNews.com</a>
        </div>
    </footer>


    <!-- JS here -->

    <!-- All JS Custom Plugins Link Here here -->
    <script src="{{ asset('assets/js/vendor/modernizr-3.5.0.min.js') }}"></script>
    <!-- Jquery, Popper, Bootstrap -->
    <script src="{{ asset('assets/js/popper.min.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
    <!-- Jquery Mobile Menu -->
    <script src="{{ asset('assets/js/jquery.slicknav.min.js') }}"></script>

    <!-- Jquery Slick , Owl-Carousel Plugins -->
    <script src="{{ asset('assets/js/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('assets/js/slick.min.js') }}"></script>
    <!-- Date Picker -->
    <script src="{{ asset('assets/js/gijgo.min.js') }}"></script>
    <!-- One Page, Animated-HeadLin -->
    <script src="{{ asset('assets/js/wow.min.js') }}"></script>
    <script src="{{ asset('assets/js/animated.headline.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.magnific-popup.js') }}"></script>

    <!-- Breaking News Plugin -->
    <script src="{{ asset('assets/js/jquery.ticker.js') }}"></script>
    <script src="{{ asset('assets/js/site.js') }}"></script>

    <!-- Scrollup, nice-select, sticky -->
    <script src="{{ asset('assets/js/jquery.scrollUp.min.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.nice-select.min.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.sticky.js') }}"></script>

    <!-- Contact js -->
    <script src="{{ asset('assets/js/contact.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.form.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('assets/js/mail-script.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.ajaxchimp.min.js') }}"></script>

    <!-- Jquery Plugins, main Jquery -->
    <script src="{{ asset('assets/js/plugins.js') }}"></script>
    <script src="{{ asset('assets/js/main.js') }}"></script>

</body>

<script>
    // Fungsi untuk mendapatkan cuaca saat ini
    function getWeather() {
        // Misalkan kita hanya menggunakan suhu contoh dan cuaca cerah
        const temperature = "34ºC";
        const weatherCondition = "Sunny";
        document.getElementById("weather-info").innerText = `${temperature}, ${weatherCondition}`;
        // Anda bisa mengupdate gambar berdasarkan kondisi cuaca
        // document.getElementById("weather-icon").src = "path/to/weather_icon.png";
    }

    // Fungsi untuk mendapatkan tanggal hari ini
    function getCurrentDate() {
        const options = {
            weekday: 'long',
            year: 'numeric',
            month: 'long',
            day: 'numeric'
        };
        const today = new Date().toLocaleDateString('id-ID', options);
        document.getElementById("date-info").innerText = today;
    }

    // Memanggil fungsi saat halaman dimuat
    window.onload = function() {
        getWeather();
        getCurrentDate();
    };
</script>

</html>