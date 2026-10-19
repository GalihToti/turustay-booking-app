<nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm sticky-top py-3 border-bottom">
    <div class="container">
        <!-- Logo -->
        <a class="navbar-brand d-flex align-items-center gap-2" href="{{ route('dashboard') }}">
            <!-- Ikon sebagai pengganti logo, gunakan image jika ada -->
            <i class="bi bi-moon-stars-fill fs-3" style="color: #8c6b4a;"></i>
            <span class="fw-bold fs-4 hotel-font text-dark" style="font-family: 'Playfair Display', serif;">TuruStay</span>
        </a>

        <!-- Hamburger Button untuk Mobile -->
        <button class="navbar-toggler border-0 shadow-none px-2" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent" aria-controls="navbarContent" aria-expanded="false" aria-label="Toggle navigation">
            <i class="bi bi-list fs-1 text-dark"></i>
        </button>

        <!-- Navbar Menu & Dropdown -->
        <div class="collapse navbar-collapse" id="navbarContent">
            <!-- Navigation Links (Kiri/Tengah) -->
            <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-4 gap-1">
                <li class="nav-item">
                    <a class="nav-link px-3 rounded-pill {{ request()->routeIs('dashboard') ? 'active bg-light fw-semibold text-dark' : 'text-muted' }}" 
                       href="{{ route('dashboard') }}">
                        <i class="bi bi-grid-1x2 me-1"></i> {{ __('Dashboard') }}
                    </a>
                </li>
            </ul>

            <!-- Settings Dropdown (Kanan) -->
            <ul class="navbar-nav ms-auto align-items-lg-center">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle d-flex align-items-center gap-2 border rounded-pill py-1 px-2 mt-3 mt-lg-0 bg-light" href="#" id="userMenu" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <div class="bg-white rounded-circle d-flex align-items-center justify-content-center shadow-sm" style="width: 32px; height: 32px;">
                            <i class="bi bi-person-fill text-secondary"></i>
                        </div>
                        <span class="fw-medium text-dark pe-2">{{ Auth::user()->name }}</span>
                    </a>
                    
                    <!-- Isi Dropdown -->
                    <ul class="dropdown-menu dropdown-menu-end border-0 shadow-lg mt-3 rounded-4 p-2" aria-labelledby="userMenu" style="min-width: 240px;">
                        <!-- User Info Profile (Khusus di dalam dropdown) -->
                        <li class="px-3 py-2">
                            <div class="d-flex flex-column">
                                <span class="fw-bold text-dark">{{ Auth::user()->name }}</span>
                                <span class="text-muted small text-truncate">{{ Auth::user()->email }}</span>
                            </div>
                        </li>
                        <li><hr class="dropdown-divider opacity-50 my-2"></li>
                        
                        <!-- Link Profil -->
                        <li>
                            <a class="dropdown-item rounded-3 py-2 d-flex align-items-center gap-2 text-secondary hover-bg-light" href="{{ route('profile.edit') }}">
                                <i class="bi bi-person-gear"></i> {{ __('Profil Saya') }}
                            </a>
                        </li>
                        
                        <!-- Link Logout -->
                        <li>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="dropdown-item rounded-3 py-2 d-flex align-items-center gap-2 text-danger">
                                    <i class="bi bi-box-arrow-right"></i> {{ __('Keluar') }}
                                </button>
                            </form>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>

<!-- Tambahan sedikit style khusus untuk mempercantik hover pada dropdown -->
<style>
    .hover-bg-light:hover {
        background-color: #f8f9fa;
        color: #212529 !important;
    }
</style>