@extends('layouts.site')

@section('title', 'Login - TuruStay')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-5">
            <div class="card shadow-sm">
                <div class="card-body p-4">
                    <h3 class="mb-1">Masuk ke TuruStay</h3>
                    <p class="text-muted">Login untuk memesan kamar dan melihat riwayat booking.</p>

                    @if (session('status'))
                        <div class="alert alert-success">{{ session('status') }}</div>
                    @endif

                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="mb-3">
                            <label class="form-label" for="email">Email</label>
                            <input type="email" id="email" name="email" value="{{ old('email') }}"
                                   required autofocus autocomplete="username"
                                   class="form-control @error('email') is-invalid @enderror">
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label" for="password">Password</label>
                            <input type="password" id="password" name="password"
                                   required autocomplete="current-password"
                                   class="form-control @error('password') is-invalid @enderror">
                            @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="remember" name="remember">
                                <label class="form-check-label" for="remember">Ingat saya</label>
                            </div>
                            @if (Route::has('password.request'))
                                <a href="{{ route('password.request') }}" class="small">Lupa password?</a>
                            @endif
                        </div>

                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary">Login</button>
                        </div>
                    </form>

                    @if (app()->environment('local'))
                        <div class="alert alert-secondary small mt-4 mb-0">
                            <strong>Akun demo (hanya tampil di lokal):</strong><br>
                            Admin: admin@gmail.com<br>
                            Tamu: tamu@gmail.com<br>
                            Password: password
                        </div>
                    @endif
                </div>

                @if (Route::has('register'))
                    <div class="card-footer bg-white text-center">
                        Belum punya akun? <a href="{{ route('register') }}">Daftar sekarang</a>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
