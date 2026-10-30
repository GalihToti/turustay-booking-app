@extends('layouts.site')

@section('title', $roomType->name . ' - TuruStay')

@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Kamar</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{ $roomType->name }}</li>
        </ol>
    </nav>

    <div class="row g-4">
        <div class="col-lg-7">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h2 class="card-title">{{ $roomType->name }}</h2>
                    <p class="text-muted">
                        <i class="bi bi-people"></i> Maks. {{ $roomType->capacity }} tamu
                    </p>
                    <p>{{ $roomType->description ?: 'Belum ada deskripsi untuk tipe kamar ini.' }}</p>

                    <h6 class="mt-4">Fasilitas</h6>
                    @forelse ($roomType->facilities as $facility)
                        <span class="badge text-bg-light border fw-normal fs-6 me-1 mb-1">
                            @if ($facility->icon)
                                <i class="bi {{ $facility->icon }}"></i>
                            @endif
                            {{ $facility->name }}
                        </span>
                    @empty
                        <p class="text-muted mb-0">Belum ada fasilitas terdaftar.</p>
                    @endforelse
                </div>
            </div>
        </div>

        <div class="col-lg-5">
            <div class="card shadow-sm">
                <div class="card-body">
                    <div class="fs-4 fw-semibold mb-3">
                        Rp {{ number_format($roomType->price_per_night, 0, ',', '.') }}
                        <small class="text-muted fs-6 fw-normal">/ malam</small>
                    </div>

                    @if ($errors->any())
                        <div class="alert alert-danger py-2">
                            <ul class="mb-0 small">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form method="GET" action="{{ route('bookings.create') }}">
                        <input type="hidden" name="room_type_id" value="{{ $roomType->id }}">

                        <div class="mb-3">
                            <label class="form-label" for="check_in">Check-in</label>
                            <input type="date" id="check_in" name="check_in" value="{{ $checkIn }}"
                                   min="{{ now()->toDateString() }}" required
                                   class="form-control @error('check_in') is-invalid @enderror">
                            @error('check_in') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="check_out">Check-out</label>
                            <input type="date" id="check_out" name="check_out" value="{{ $checkOut }}"
                                   min="{{ now()->addDay()->toDateString() }}" required
                                   class="form-control @error('check_out') is-invalid @enderror">
                            @error('check_out') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="guests">Jumlah tamu</label>
                            <input type="number" id="guests" name="guests" value="{{ $guests ?? 1 }}"
                                   min="1" max="{{ $roomType->capacity }}" required
                                   class="form-control @error('guests') is-invalid @enderror">
                            @error('guests') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        @if (! is_null($availableCount))
                            @if ($availableCount > 0)
                                <div class="alert alert-success py-2">{{ $availableCount }} kamar tersedia pada tanggal ini.</div>
                            @else
                                <div class="alert alert-danger py-2">Semua kamar penuh pada tanggal ini.</div>
                            @endif
                        @endif

                        @auth
                            <button type="submit" class="btn btn-primary w-100">Lanjut booking</button>
                        @else
                            <p class="small text-muted">Kamu perlu login untuk melanjutkan booking.</p>
                            <button type="submit" class="btn btn-primary w-100">Login dan lanjut booking</button>
                        @endauth
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
