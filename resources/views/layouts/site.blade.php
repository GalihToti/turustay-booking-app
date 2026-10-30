<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'TuruStay - Kenyamanan Sempurna Menanti Anda')</title>

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <!-- Fonts: Inter -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f8f9fa;
            color: #1f2937;
            overflow-x: hidden;
        }

        /* Navbar Wireframe */
        .navbar-wireframe {
            background-color: #ffffff;
            border-bottom: 1px solid #e5e7eb;
            height: 80px;
        }

        .nav-link-wf {
            color: #4b5563;
            font-weight: 500;
            padding: 0.5rem 1rem !important;
            transition: color 0.2s ease;
        }

        .nav-link-wf:hover,
        .nav-link-wf.active {
            color: #0d6efd !important;
        }

        .logo-box {
            width: 34px;
            height: 34px;
            background-color: #1f2937;
            border-radius: 6px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #ffffff;
        }

        /* Footer Wireframe */
        .footer-wireframe {
            background-color: #111827;
            color: #d1d5db;
            border-top: 4px solid #0d6efd;
        }

        .footer-wireframe h6 {
            color: #ffffff;
            letter-spacing: 0.05em;
        }

        .footer-wireframe a {
            color: #9ca3af;
            text-decoration: none;
            transition: color 0.2s ease;
        }

        .footer-wireframe a:hover {
            color: #ffffff;
        }

        .social-btn {
            width: 38px;
            height: 38px;
            background-color: #1f2937;
            color: #ffffff;
            border-radius: 6px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            transition: background-color 0.2s ease;
            text-decoration: none;
        }

        .social-btn:hover {
            background-color: #0d6efd;
            color: #ffffff;
        }

        .grow {
            flex-grow: 1;
        }
    </style>
</head>

<body class="d-flex flex-column min-vh-100">

    <!-- 1. Header / Navbar Wireframe -->
    <header class="navbar navbar-expand-lg navbar-wireframe sticky-top">
        <div class="container h-100">
            <!-- Brand / Logo -->
            <a class="navbar-brand d-flex align-items-center gap-2" href="{{ route('home') }}">
                <div class="logo-box">
                    <i class="bi bi-moon-stars-fill fs-6"></i>
                </div>
                <span class="fs-4 fw-bold mb-0 tracking-tight" style="color: #111827;">Turustay</span>
            </a>

            <!-- Toggle Mobile -->
            <button class="navbar-toggler border-0 shadow-none px-2" type="button" data-bs-toggle="collapse" data-bs-target="#mainNav" aria-controls="mainNav" aria-expanded="false" aria-label="Toggle navigation">
                <i class="bi bi-list fs-1 text-dark"></i>
            </button>

            <!-- Navigation Links -->
            <div class="collapse navbar-collapse bg-white bg-lg-transparent p-3 p-lg-0 rounded-3 shadow-sm shadow-lg-none" id="mainNav">
                <nav class="navbar-nav mx-auto gap-lg-2">
                    <a class="nav-link nav-link-wf" href="{{ route('home') }}#kamar">Kamar</a>
                    <a class="nav-link nav-link-wf" href="{{ route('home') }}#fasilitas">Fasilitas</a>
                    <a class="nav-link nav-link-wf" href="{{ route('home') }}#tentang">Tentang</a>
                    <a class="nav-link nav-link-wf" href="{{ route('home') }}#lokasi">Lokasi</a>

                    @auth
                        @if (auth()->user()->role === 'admin')
                            <a class="nav-link nav-link-wf text-danger fw-semibold" href="{{ route('admin.dashboard') }}">
                                <i class="bi bi-shield-lock me-1"></i> Panel Admin
                            </a>
                        @else
                            <a class="nav-link nav-link-wf text-primary fw-semibold" href="{{ route('bookings.index') }}">
                                <i class="bi bi-journal-text me-1"></i> Booking Saya
                            </a>
                        @endif
                    @endauth
                </nav>

                <!-- CTA & Auth -->
                <div class="d-flex align-items-center gap-3 mt-3 mt-lg-0">
                    <span class="text-muted small fw-medium d-none d-xl-inline">ID | EN</span>

                    @auth
                        <div class="dropdown">
                            <button class="btn btn-light border dropdown-toggle d-flex align-items-center gap-2 rounded-3 py-2 px-3" type="button" id="userMenu" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="bi bi-person-circle text-primary"></i>
                                <span class="fw-medium small">{{ auth()->user()->name }}</span>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end shadow border-0 mt-2 rounded-3 p-2" aria-labelledby="userMenu">
                                <li class="px-3 py-2">
                                    <span class="fw-bold d-block">{{ auth()->user()->name }}</span>
                                    <span class="text-muted small">{{ auth()->user()->email }}</span>
                                </li>
                                <li><hr class="dropdown-divider my-1"></li>
                                @if (auth()->user()->role === 'admin')
                                    <li><a class="dropdown-item rounded-2" href="{{ route('admin.dashboard') }}">Dashboard Admin</a></li>
                                @else
                                    <li><a class="dropdown-item rounded-2" href="{{ route('bookings.index') }}">Riwayat Booking</a></li>
                                @endif
                                <li><hr class="dropdown-divider my-1"></li>
                                <li>
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <button type="submit" class="dropdown-item text-danger rounded-2 d-flex align-items-center gap-2">
                                            <i class="bi bi-box-arrow-right"></i> Logout
                                        </button>
                                    </form>
                                </li>
                            </ul>
                        </div>
                    @else
                        @if (Route::has('login'))
                            <a href="{{ route('login') }}" class="btn btn-outline-secondary px-3 py-2 rounded-3 text-sm fw-medium">Masuk</a>
                        @endif
                        <a href="{{ route('home') }}#kamar" class="btn btn-primary px-4 py-2 rounded-3 text-sm fw-semibold">
                            Pesan Sekarang
                        </a>
                    @endauth
                </div>
            </div>
        </div>
    </header>

    <!-- Konten Utama -->
    @if (request()->routeIs('home'))
        <main class="grow">
            <!-- Flash Messages Khusus Beranda -->
            <div class="container mt-3">
                @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm rounded-3" role="alert">
                    <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Tutup"></button>
                </div>
                @endif

                @if (session('error'))
                <div class="alert alert-danger alert-dismissible fade show border-0 shadow-sm rounded-3" role="alert">
                    <i class="bi bi-exclamation-triangle-fill me-2"></i> {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Tutup"></button>
                </div>
                @endif
            </div>

            @yield('content')
        </main>
    @else
        <!-- Halaman Selain Beranda: Otomatis dibungkus container rapi -->
        <main class="grow container py-4 my-2">
            <!-- Flash Messages -->
            @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm rounded-3 mb-4" role="alert">
                <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Tutup"></button>
            </div>
            @endif

            @if (session('error'))
            <div class="alert alert-danger alert-dismissible fade show border-0 shadow-sm rounded-3 mb-4" role="alert">
                <i class="bi bi-exclamation-triangle-fill me-2"></i> {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Tutup"></button>
            </div>
            @endif

            @yield('content')
        </main>
    @endif

    <!-- 9. Footer Wireframe -->
    <footer class="footer-wireframe pt-5 pb-4 mt-auto">
        <div class="container">
            <div class="row g-4 mb-5">
                <!-- Col 1: Brand -->
                <div class="col-lg-4 col-md-6">
                    <div class="d-flex align-items-center gap-2 mb-3">
                        <div class="logo-box bg-white text-dark">
                            <i class="bi bi-moon-stars-fill"></i>
                        </div>
                        <span class="fs-4 fw-bold text-white tracking-tight">Turustay</span>
                    </div>
                    <p class="text-secondary small leading-relaxed pe-lg-4 mb-0">
                        Menghadirkan harmoni sempurna antara kenyamanan rumah dan kemewahan hotel untuk masa inap yang berkesan.
                    </p>
                </div>

                <!-- Col 2: Quick Links -->
                <div class="col-lg-2 col-md-6 col-6">
                    <h6 class="text-uppercase fw-bold small mb-3">Tautan Cepat</h6>
                    <ul class="list-unstyled small d-flex flex-column gap-2 mb-0">
                        <li><a href="{{ route('home') }}#tentang">Tentang Kami</a></li>
                        <li><a href="{{ route('home') }}#kamar">Pilihan Kamar</a></li>
                        <li><a href="{{ route('home') }}#fasilitas">Fasilitas</a></li>
                        <li><a href="{{ route('home') }}#lokasi">Lokasi & Akses</a></li>
                    </ul>
                </div>

                <!-- Col 3: Socials -->
                <div class="col-lg-3 col-md-6 col-6">
                    <h6 class="text-uppercase fw-bold small mb-3">Ikuti Kami</h6>
                    <div class="d-flex gap-2">
                        <a href="#" class="social-btn" title="Instagram"><i class="bi bi-instagram"></i></a>
                        <a href="#" class="social-btn" title="Facebook"><i class="bi bi-facebook"></i></a>
                        <a href="#" class="social-btn" title="Twitter / X"><i class="bi bi-twitter-x"></i></a>
                    </div>
                </div>

                <!-- Col 4: Newsletter -->
                <div class="col-lg-3 col-md-6">
                    <h6 class="text-uppercase fw-bold small mb-3">Berlangganan Promo</h6>
                    <p class="text-secondary small mb-3">Dapatkan penawaran eksklusif langsung ke kotak masuk Anda.</p>
                    <form class="d-flex flex-column gap-2" onsubmit="event.preventDefault(); alert('Terima kasih telah berlangganan promo TuruStay!');">
                        <input type="email" placeholder="Alamat Email" class="form-control form-control-sm bg-dark text-white border-secondary" required>
                        <button type="submit" class="btn btn-primary btn-sm fw-semibold">Daftar Sekarang</button>
                    </form>
                </div>
            </div>

            <div class="border-top border-secondary pt-3 text-center text-secondary small">
                &copy; {{ date('Y') }} Turustay Hotel. Hak Cipta Dilindungi.
            </div>
        </div>
    </footer>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</body>

</html>
