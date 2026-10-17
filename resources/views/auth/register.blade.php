@extends('layouts.site')

@section('title', 'Daftar - TuruStay')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-5">
            <div class="card shadow-sm">
                <div class="card-body p-4">
                    <h3 class="mb-1">Buat akun TuruStay</h3>
                    <p class="text-muted">Daftar gratis untuk mulai memesan kamar.</p>

                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="mb-3">
                            <label class="form-label" for="name">Nama lengkap</label>
                            <input type="text" id="name" name="name" value="{{ old('name') }}"
                                   required autofocus autocomplete="name"
                                   class="form-control @error('name') is-invalid @enderror">
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label" for="email">Email</label>
                            <input type="email" id="email" name="email" value="{{ old('email') }}"
                                   required autocomplete="username"
                                   class="form-control @error('email') is-invalid @enderror">
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label" for="password">Password</label>
                            <input type="password" id="password" name="password"
                                   required autocomplete="new-password"
                                   class="form-control @error('password') is-invalid @enderror">
                            @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label" for="password_confirmation">Konfirmasi password</label>
                            <input type="password" id="password_confirmation" name="password_confirmation"
                                   required autocomplete="new-password"
                                   class="form-control @error('password_confirmation') is-invalid @enderror">
                            @error('password_confirmation')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary">Daftar</button>
                        </div>
                    </form>
                </div>

                @if (Route::has('login'))
                    <div class="card-footer bg-white text-center">
                        Sudah punya akun? <a href="{{ route('login') }}">Login</a>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
