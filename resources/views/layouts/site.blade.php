<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'TuruStay')</title>

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <!-- Fonts: Plus Jakarta Sans Only -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:ital,wght@0,200..800;1,200..800&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: #fbfaf8;
            /* Warna background hotel cozy */
        }

        /* Mengatur ketebalan heading untuk Plus Jakarta Sans */
        h1 {
            font-weight: 700;
        }

        h2,
        h3,
        .hotel-font {
            font-weight: 600;
        }

        /* Styling Navbar Custom */
        .navbar-custom {
            background-color: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-bottom: 1px solid rgba(0, 0, 0, 0.05);
        }

        .nav-link-custom {
            color: #495057;
            font-weight: 500;
            padding: 0.5rem 1rem !important;
            border-radius: 50rem;
            transition: all 0.2s ease;
        }

        .nav-link-custom:hover,
        .nav-link-custom.active {
            background-color: #f0e9e1;
            color: #8c6b4a !important;
        }

        .btn-brand {
            background-color: #2c3e50;
            color: #fff;
            border: none;
            transition: all 0.3s ease;
        }

        .btn-brand:hover {
            background-color: #1a252f;
            color: #fff;
            transform: translateY(-2px);
        }

        /* Memastikan footer selalu di bawah */
        .grow {
            flex-grow: 1;
        }
    </style>
</head>

<body class="d-flex flex-column min-vh-100">

    <nav class="navbar navbar-expand-lg navbar-custom sticky-top py-3">
        <div class="container">
            <!-- Brand Logo -->
            <a class="navbar-brand d-flex align-items-center gap-2" href="{{ route('home') }}">
                <i class="bi bi-moon-stars-fill fs-4" style="color: #8c6b4a;"></i>
                <span class="fs-4 hotel-font fw-bold text-dark mb-0">TuruStay</span>
            </a>

            <!-- Hamburger Button -->
            <button class="navbar-toggler border-0 shadow-none px-2" type="button" data-bs-toggle="collapse" data-bs-target="#mainNav" aria-controls="mainNav" aria-expanded="false" aria-label="Buka menu">
                <i class="bi bi-list fs-1 text-dark"></i>
            </button>

            <!-- Menu List -->
            <div class="collapse navbar-collapse mt-3 mt-lg-0" id="mainNav">
                <ul class="navbar-nav me-auto ms-lg-4 gap-1">
                    <li class="nav-item">
                        <a class="nav-link nav-link-custom {{ request()->routeIs('home', 'rooms.*') ? 'active' : '' }}" href="{{ route('home') }}">
                            <i class="bi bi-door-open me-1"></i> Kamar
                        </a>
                    </li>

                    @auth
                    @if (auth()->user()->role === 'admin')
                    <li class="nav-item">
                        <a class="nav-link nav-link-custom {{ request()->routeIs('admin.*') ? 'active' : '' }}" href="{{ route('admin.dashboard') }}">
                            <i class="bi bi-grid-1x2 me-1"></i> Panel Admin
                        </a>
                    </li>
                    @else
                    <li class="nav-item">
                        <a class="nav-link nav-link-custom {{ request()->routeIs('bookings.*') ? 'active' : '' }}" href="{{ route('bookings.index') }}">
                            <i class="bi bi-journal-check me-1"></i> Booking Saya
                        </a>
                    </li>
                    @endif
                    @endauth
                </ul>

                <!-- Auth/Profile Menu (Kanan) -->
                <ul class="navbar-nav ms-auto align-items-lg-center gap-2 mt-3 mt-lg-0">
                    @auth
                    <!-- Dropdown Profil Jika Sudah Login -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle d-flex align-items-center gap-2 border rounded-pill py-1 px-2 bg-white shadow-sm" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <div class="rounded-circle d-flex align-items-center justify-content-center" style="width: 32px; height: 32px; background-color: #f0e9e1; color: #8c6b4a;">
                                <i class="bi bi-person-fill"></i>
                            </div>
                            <span class="fw-medium text-dark pe-2">{{ auth()->user()->name }}</span>
                        </a>

                        <ul class="dropdown-menu dropdown-menu-end border-0 shadow-lg mt-3 rounded-4 p-2" aria-labelledby="userDropdown">
                            <li class="px-3 py-2">
                                <span class="fw-bold text-dark d-block">{{ auth()->user()->name }}</span>
                                <span class="text-muted small">Tamu Terhormat</span>
                            </li>
                            <li>
                                <hr class="dropdown-divider opacity-50 my-2">
                            </li>

                            @if (Route::has('logout'))
                            <li>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="dropdown-item rounded-3 py-2 d-flex align-items-center gap-2 text-danger">
                                        <i class="bi bi-box-arrow-right"></i> Logout
                                    </button>
                                </form>
                            </li>
                            @endif
                        </ul>
                    </li>
                    @else
                    <!-- Tombol Login/Register Jika Belum Login -->
                    @if (Route::has('login'))
                    <li class="nav-item">
                        <a class="nav-link fw-medium text-dark px-3" href="{{ route('login') }}">Masuk</a>
                    </li>
                    @endif
                    @if (Route::has('register'))
                    <li class="nav-item">
                        <a class="btn btn-brand rounded-pill px-4" href="{{ route('register') }}">Daftar Sekarang</a>
                    </li>
                    @endif
                    @endauth
                </ul>
            </div>
        </div>
    </nav>

    <!-- Konten Utama -->
    <main class="grow">
        <!-- Alert (Dibungkus container agar rapi) -->
        <div class="container mt-4">
            @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show shadow-sm border-0 rounded-3" role="alert">
                <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Tutup"></button>
            </div>
            @endif

            @if (session('error'))
            <div class="alert alert-danger alert-dismissible fade show shadow-sm border-0 rounded-3" role="alert">
                <i class="bi bi-exclamation-triangle-fill me-2"></i> {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Tutup"></button>
            </div>
            @endif
        </div>

        <!-- Render View -->
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-white border-top py-4 mt-auto">
        <div class="container text-center text-muted">
            <i class="bi bi-moon-stars-fill mb-2 d-block" style="color: #8c6b4a; font-size: 1.5rem;"></i>
            <span class="hotel-font fw-bold text-dark fs-5">TuruStay</span>
            <p class="small mt-2 mb-0">&copy; {{ date('Y') }} TuruStay. Istirahat tenang, pesan mudah.</p>
        </div>
    </footer>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</body>

</html>