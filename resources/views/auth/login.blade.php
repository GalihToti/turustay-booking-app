@extends('layouts.site')

@section('title', 'Login - TuruStay')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/auth.css') }}">
@endpush

@section('content')
<div class="d-flex flex-column align-items-center w-100 my-3 my-md-4 px-3">
    <!-- Tombol Kembali ke Landing Page -->
    <div class="w-100 mb-3" style="max-width: 1000px;">
        <a href="{{ route('home') }}" class="btn btn-light border btn-sm rounded-pill px-3 py-2 d-inline-flex align-items-center gap-2 text-dark shadow-sm bg-white">
            <i class="fa-solid fa-arrow-left"></i> Kembali ke Beranda
        </a>
    </div>

    <div class="auth-container row g-0">
        <!-- Left Column (Branding/Illustration) -->
        <div class="col-md-5 auth-left">
            <div class="auth-left-content h-100 d-flex flex-column">
                <a href="{{ route('home') }}" class="brand-logo text-decoration-none">
                    <i class="fa-solid fa-mountain-sun"></i> Turustay
                </a>
                <div class="mt-auto mb-auto">
                    <h2 class="display-6 fw-bold mb-3">Welcome Back to Turustay!</h2>
                    <p class="text-dark fs-5 opacity-75">Log in to continue your journey with us.</p>
                </div>
            </div>
        </div>

        <!-- Right Column (Form) -->
        <div class="col-md-7 auth-right">
            <div class="w-100" style="max-width: 450px; margin: 0 auto;">
                <div class="d-md-none text-center mb-3">
                    <a href="{{ route('home') }}" class="brand-logo justify-content-center text-decoration-none mb-0">
                        <i class="fa-solid fa-mountain-sun"></i> Turustay
                    </a>
                </div>
                <h2 class="mb-2">Login</h2>
                <p class="text-muted mb-4">Enter your account details</p>

                @if (session('status'))
                    <div class="alert alert-success border-0 shadow-sm rounded-3 mb-3">{{ session('status') }}</div>
                @endif

                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <!-- Email -->
                    <div class="mb-3 input-icon-wrapper">
                        <i class="fa-regular fa-envelope left-icon"></i>
                        <input type="email" id="email" name="email" value="{{ old('email') }}"
                               placeholder="Email Address" required autofocus autocomplete="username"
                               class="form-control @error('email') is-invalid @enderror">
                        @error('email')
                            <div class="invalid-feedback ps-2">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Password -->
                    <div class="mb-3 input-icon-wrapper has-right-icon">
                        <i class="fa-solid fa-lock left-icon"></i>
                        <input type="password" id="password" name="password"
                               placeholder="Password" required autocomplete="current-password"
                               class="form-control @error('password') is-invalid @enderror">
                        <i class="fa-regular fa-eye-slash right-icon" title="Toggle password visibility"></i>
                        @error('password')
                            <div class="invalid-feedback ps-2">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Remember & Forgot -->
                    <div class="d-flex justify-content-between align-items-center mb-4 text-sm">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="remember" name="remember" {{ old('remember') ? 'checked' : '' }}>
                            <label class="form-check-label text-muted" for="remember">Remember me</label>
                        </div>
                        @if (Route::has('password.request'))
                            <a href="{{ route('password.request') }}" class="text-muted text-decoration-none">Forgot Password?</a>
                        @endif
                    </div>

                    <!-- Login Button -->
                    <button type="submit" class="btn btn-primary-custom w-100 mb-3">Login</button>

                    <!-- Divider -->
                    <div class="divider">or continue with</div>

                    <!-- Social Login -->
                    <div class="row g-3 mb-4">
                        <div class="col-6">
                            <button type="button" class="btn btn-social w-100">
                                <i class="fa-brands fa-google text-danger"></i> Google
                            </button>
                        </div>
                        <div class="col-6">
                            <button type="button" class="btn btn-social w-100">
                                <i class="fa-brands fa-apple fs-5"></i> Apple
                            </button>
                        </div>
                    </div>

                    <!-- Toggle to Sign Up -->
                    <div class="text-center text-sm">
                        <span class="text-muted">Don't have an account?</span>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="link-custom ms-1">Sign Up</a>
                        @endif
                    </div>
                </form>

                @if (app()->environment('local'))
                    <div class="alert alert-secondary small mt-4 mb-0 rounded-3">
                        <strong>Akun demo (hanya tampil di lokal):</strong><br>
                        Admin: <code>admin@gmail.com</code> &bull; Tamu: <code>tamu@gmail.com</code><br>
                        Password: <code>password</code>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.querySelectorAll('.right-icon').forEach(icon => {
        icon.addEventListener('click', function() {
            const input = this.closest('.input-icon-wrapper').querySelector('input');
            if (input.type === 'password') {
                input.type = 'text';
                this.classList.remove('fa-eye-slash');
                this.classList.add('fa-eye');
            } else {
                input.type = 'password';
                this.classList.remove('fa-eye');
                this.classList.add('fa-eye-slash');
            }
        });
    });
</script>
@endpush
