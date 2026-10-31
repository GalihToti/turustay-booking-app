<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'TuruStay - Pengalaman Menginap yang Tak Terlupakan')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    @stack('styles')
</head>

<body class="d-flex flex-column min-vh-100">

    @unless (request()->routeIs('login', 'register'))
        <!-- 1. Navbar Partial -->
        @include('layouts.partials.navbar')
    @endunless

    <!-- Konten Utama -->
    <main class="grow {{ request()->routeIs('login', 'register') ? 'd-flex align-items-center justify-content-center py-4' : (request()->routeIs('home') ? '' : 'container py-4 my-2') }}">
        @include('layouts.partials.alerts')
        @yield('content')
    </main>

    @unless (request()->routeIs('login', 'register'))
        <!-- Footer -->
        <footer class="footer mt-auto">
        <div class="container">
            <div class="row gy-4">
                <!-- Col 1 -->
                <div class="col-lg-4 pe-lg-5">
                    <a href="{{ route('home') }}" class="d-inline-flex align-items-center gap-2 text-white fs-4 fw-bold mb-3 text-decoration-none">
                        <i class="fa-solid fa-mountain-sun"></i> Turustay
                    </a>
                    <p class="text-light mb-0 opacity-75">Stay Better, Explore More</p>
                </div>

                <!-- Col 2 -->
                <div class="col-lg-2 col-md-4">
                    <h6 class="text-white fw-bold mb-3">Navigasi</h6>
                    <ul class="list-unstyled d-flex flex-column gap-2 mb-0">
                        <li><a href="{{ route('home') }}">Beranda</a></li>
                        <li><a href="{{ route('home') }}#fasilitas">Fasilitas</a></li>
                        <li><a href="{{ route('home') }}#kamar">Kamar</a></li>
                        <li><a href="{{ route('home') }}#tentang">Tentang Kami</a></li>
                        <li><a href="{{ route('home') }}#lokasi">Lokasi</a></li>
                    </ul>
                </div>

                <!-- Col 3 -->
                <div class="col-lg-3 col-md-4">
                    <h6 class="text-white fw-bold mb-3">Kontak</h6>
                    <ul class="list-unstyled d-flex flex-column gap-3 mb-0">
                        <li class="d-flex align-items-start gap-2">
                            <i class="fa-solid fa-phone mt-1 text-light opacity-75"></i>
                            <span class="text-light opacity-75">+62 21 1234 5678</span>
                        </li>
                        <li class="d-flex align-items-start gap-2">
                            <i class="fa-solid fa-envelope mt-1 text-light opacity-75"></i>
                            <span class="text-light opacity-75">turustay@gmail.com</span>
                        </li>
                        <li class="d-flex align-items-start gap-2">
                            <i class="fa-solid fa-location-dot mt-1 text-light opacity-75"></i>
                            <span class="text-light opacity-75">Jl. Melati No. 10, Jakarta</span>
                        </li>
                    </ul>
                </div>

                <!-- Col 4 -->
                <div class="col-lg-3 col-md-4">
                    <h6 class="text-white fw-bold mb-3">Ikuti Kami</h6>
                    <div class="d-flex gap-3">
                        <a href="#" aria-label="Ikuti Turustay di Instagram"><i class="fa-brands fa-instagram fs-5"></i></a>
                        <a href="#" aria-label="Ikuti Turustay di Facebook"><i class="fa-brands fa-facebook fs-5"></i></a>
                        <a href="#" aria-label="Ikuti Turustay di X (Twitter)"><i class="fa-brands fa-x-twitter fs-5"></i></a>
                        <a href="#" aria-label="Ikuti Turustay di YouTube"><i class="fa-brands fa-youtube fs-5"></i></a>
                    </div>
                </div>
            </div>

            <!-- Footer Bottom -->
            <div class="footer-bottom d-flex flex-column flex-md-row justify-content-between align-items-center gap-3">
                <span>&copy; {{ date('Y') }} Turustay. All rights reserved.</span>
                <div class="d-flex gap-3">
                    <a href="#">Syarat & Ketentuan</a>
                    <span>|</span>
                    <a href="#">Kebijakan Privasi</a>
                </div>
            </div>
        </div>
        </footer>
    @endunless

    <!-- Bootstrap 5 JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    @stack('scripts')
</body>

</html>
