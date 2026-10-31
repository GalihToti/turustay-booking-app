<nav class="navbar navbar-expand-lg navbar-light bg-white sticky-top py-3 shadow-sm">
    <div class="container">
        <a class="navbar-brand d-flex align-items-center gap-2" href="{{ route('home') }}">
            <i class="fa-solid fa-mountain-sun"></i> Turustay
        </a>
        <button class="navbar-toggler border-0 shadow-none" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav mx-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('home') && !request()->has('check_in') ? 'active' : '' }}" href="{{ route('home') }}">Beranda</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('home') }}#kamar">Kamar</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('home') }}#fasilitas">Fasilitas</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('home') }}#lokasi">Lokasi</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('home') }}#tentang">Tentang Kami</a>
                </li>
                @auth
                    @if (auth()->user()->role === 'admin')
                        <li class="nav-item">
                            <a class="nav-link text-danger fw-semibold" href="{{ route('admin.dashboard') }}">
                                <i class="fa-solid fa-shield-halved me-1"></i> Panel Admin
                            </a>
                        </li>
                    @else
                        <li class="nav-item">
                            <a class="nav-link text-primary fw-semibold" href="{{ route('bookings.index') }}">
                                <i class="fa-solid fa-book-bookmark me-1"></i> Booking Saya
                            </a>
                        </li>
                    @endif
                @endauth
            </ul>
            <div class="d-flex align-items-center gap-3">
                @auth
                    <div class="dropdown">
                        <button class="btn btn-light border dropdown-toggle d-flex align-items-center gap-2 rounded-3 py-2 px-3" type="button" id="userMenu" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fa-solid fa-circle-user text-primary-custom"></i>
                            <span class="fw-medium small">{{ auth()->user()->name }}</span>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end shadow border-0 mt-2 rounded-3 p-2" aria-labelledby="userMenu">
                            <li class="px-3 py-2">
                                <span class="fw-bold d-block">{{ auth()->user()->name }}</span>
                                <span class="text-muted small">{{ auth()->user()->email }}</span>
                            </li>
                            <li><hr class="dropdown-divider my-1"></li>
                            @if (auth()->user()->role === 'admin')
                                <li><a class="dropdown-item rounded-2" href="{{ route('admin.dashboard') }}"><i class="fa-solid fa-gauge me-2"></i> Dashboard Admin</a></li>
                            @else
                                <li><a class="dropdown-item rounded-2" href="{{ route('bookings.index') }}"><i class="fa-solid fa-receipt me-2"></i> Riwayat Booking</a></li>
                            @endif
                            <li><hr class="dropdown-divider my-1"></li>
                            <li>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="dropdown-item text-danger rounded-2 d-flex align-items-center">
                                        <i class="fa-solid fa-right-from-bracket me-2"></i> Logout
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </div>
                @else
                    @if (Route::has('login'))
                        <a href="{{ route('login') }}" class="btn btn-outline-secondary px-3 py-2 rounded-3 text-sm fw-medium">Masuk</a>
                    @endif
                    <a href="{{ route('home') }}#kamar" class="btn btn-primary-custom">Pesan Sekarang</a>
                @endauth
            </div>
        </div>
    </div>
</nav>
