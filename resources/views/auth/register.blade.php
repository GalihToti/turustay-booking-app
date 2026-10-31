@extends('layouts.site')

@section('title', 'Daftar - TuruStay')

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
                    <h2 class="display-6 fw-bold mb-3">Welcome to Turustay!</h2>
                    <p class="text-dark fs-5 opacity-75">Start your journey with us by creating an account.</p>
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
                <h2 class="mb-2">Sign Up</h2>
                <p class="text-muted mb-4">Create your account to unlock exclusive benefits</p>

                <form method="POST" action="{{ route('register') }}">
                    @csrf

                    <!-- Full Name -->
                    <div class="mb-3 input-icon-wrapper">
                        <i class="fa-regular fa-user left-icon"></i>
                        <input type="text" id="name" name="name" value="{{ old('name') }}"
                               placeholder="Full Name" required autofocus autocomplete="name"
                               class="form-control @error('name') is-invalid @enderror">
                        @error('name')
                            <div class="invalid-feedback ps-2">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Email -->
                    <div class="mb-3 input-icon-wrapper">
                        <i class="fa-regular fa-envelope left-icon"></i>
                        <input type="email" id="email" name="email" value="{{ old('email') }}"
                               placeholder="Email Address" required autocomplete="username"
                               class="form-control @error('email') is-invalid @enderror">
                        @error('email')
                            <div class="invalid-feedback ps-2">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Password -->
                    <div class="mb-3 input-icon-wrapper has-right-icon">
                        <i class="fa-solid fa-lock left-icon"></i>
                        <input type="password" id="password" name="password"
                               placeholder="Password" required autocomplete="new-password"
                               class="form-control @error('password') is-invalid @enderror">
                        <i class="fa-regular fa-eye-slash right-icon" title="Toggle password visibility"></i>
                        @error('password')
                            <div class="invalid-feedback ps-2">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Confirm Password -->
                    <div class="mb-3 input-icon-wrapper has-right-icon">
                        <i class="fa-solid fa-lock left-icon"></i>
                        <input type="password" id="password_confirmation" name="password_confirmation"
                               placeholder="Confirm Password" required autocomplete="new-password"
                               class="form-control @error('password_confirmation') is-invalid @enderror">
                        <i class="fa-regular fa-eye-slash right-icon" title="Toggle password visibility"></i>
                        @error('password_confirmation')
                            <div class="invalid-feedback ps-2">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Terms & Conditions Checkbox -->
                    <div class="form-check mb-4 text-sm mt-2">
                        <input class="form-check-input mt-1" type="checkbox" id="termsCheck" required checked>
                        <label class="form-check-label text-muted" for="termsCheck">
                            I agree to the <a href="#" class="text-dark fw-semibold text-decoration-none">Terms & Conditions</a>
                            and <a href="#" class="text-dark fw-semibold text-decoration-none">Privacy Policy</a>
                        </label>
                    </div>

                    <!-- Sign Up Button -->
                    <button type="submit" class="btn btn-primary-custom w-100 mb-3">Create Account</button>

                    <!-- Divider -->
                    <div class="divider">or sign up with</div>

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

                    <!-- Toggle to Login -->
                    <div class="text-center text-sm">
                        <span class="text-muted">Already have an account?</span>
                        @if (Route::has('login'))
                            <a href="{{ route('login') }}" class="link-custom ms-1">Login</a>
                        @endif
                    </div>
                </form>
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
