@extends('layouts.site')

@section('title', 'TuruStay - Booking Penginapan')

@section('content')
    <div class="p-4 p-md-5 mb-4 bg-primary-subtle rounded-3">
        <h1 class="display-6 fw-bold">Istirahat tenang, pesan mudah.</h1>
        <p class="lead mb-4">Pilih tanggal menginap dan temukan kamar yang tersedia di TuruStay.</p>

        <form method="GET" action="{{ route('home') }}" class="row g-2 align-items-start">
            <div class="col-md-3">
                <label class="form-label" for="check_in">Check-in</label>
                <input type="date" id="check_in" name="check_in" value="{{ $checkIn }}"
                       min="{{ now()->toDateString() }}"
                       class="form-control @error('check_in') is-invalid @enderror">
                @error('check_in')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-md-3">
                <label class="form-label" for="check_out">Check-out</label>
                <input type="date" id="check_out" name="check_out" value="{{ $checkOut }}"
                       min="{{ now()->addDay()->toDateString() }}"
                       class="form-control @error('check_out') is-invalid @enderror">
                @error('check_out')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-md-3">
                <label class="form-label" for="guests">Jumlah tamu</label>
                <input type="number" id="guests" name="guests" value="{{ $guests }}" min="1"
                       placeholder="Semua"
                       class="form-control @error('guests') is-invalid @enderror">
                @error('guests')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-md-3 d-flex gap-2" style="margin-top: 2rem;">
                <button type="submit" class="btn btn-primary flex-grow-1">
                    <i class="bi bi-search"></i> Cari kamar
                </button>
                @if ($searched || $guests)
                    <a href="{{ route('home') }}" class="btn btn-outline-secondary">Reset</a>
                @endif
            </div>
        </form>
    </div>

    @if ($searched)
        <p class="text-muted">
            Menampilkan ketersediaan untuk
            <strong>{{ \Carbon\Carbon::parse($checkIn)->format('d M Y') }}</strong> sampai
            <strong>{{ \Carbon\Carbon::parse($checkOut)->format('d M Y') }}</strong>.
        </p>
    @endif

    <div class="row g-4">
        @forelse ($roomTypes as $type)
            <div class="col-md-6 col-lg-4">
                <div class="card h-100 shadow-sm">
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title">{{ $type->name }}</h5>
                        <p class="text-muted small mb-2">
                            <i class="bi bi-people"></i> Maks. {{ $type->capacity }} tamu
                        </p>
                        <p class="card-text">{{ \Illuminate\Support\Str::limit($type->description, 90) }}</p>

                        <div class="mb-3">
                            @foreach ($type->facilities as $facility)
                                <span class="badge text-bg-light border fw-normal">{{ $facility->name }}</span>
                            @endforeach
                        </div>

                        <div class="mt-auto">
                            <div class="fs-5 fw-semibold mb-2">
                                Rp {{ number_format($type->price_per_night, 0, ',', '.') }}
                                <small class="text-muted fs-6 fw-normal">/ malam</small>
                            </div>

                            @if ($searched)
                                @if ($type->available_count > 0)
                                    <span class="badge text-bg-success mb-2">{{ $type->available_count }} kamar tersedia</span>
                                @else
                                    <span class="badge text-bg-danger mb-2">Penuh pada tanggal ini</span>
                                @endif
                            @endif

                            <div class="d-grid">
                                <a href="{{ route('rooms.show', array_merge(['roomType' => $type->id], $search)) }}"
                                   class="btn btn-outline-primary">Lihat detail</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="alert alert-info mb-0">Belum ada tipe kamar yang sesuai.</div>
            </div>
        @endforelse
    </div>
    <section class="mt-5">
        <h3 class="text-center mb-4">Kenapa TuruStay?</h3>
        <div class="row g-4 text-center">
            <div class="col-md-4">
                <i class="bi bi-lightning-charge fs-1 text-primary"></i>
                <h5 class="mt-2">Booking cepat</h5>
                <p class="text-muted">Pilih tanggal, pilih kamar, selesai dalam hitungan menit.</p>
            </div>
            <div class="col-md-4">
                <i class="bi bi-shield-check fs-1 text-primary"></i>
                <h5 class="mt-2">Ketersediaan akurat</h5>
                <p class="text-muted">Sistem otomatis mencegah satu kamar dipesan di tanggal yang bentrok.</p>
            </div>
            <div class="col-md-4">
                <i class="bi bi-cup-hot fs-1 text-primary"></i>
                <h5 class="mt-2">Fasilitas jelas</h5>
                <p class="text-muted">Dari WiFi sampai sarapan, semua terlihat sebelum kamu memesan.</p>
            </div>
        </div>
    </section>

    <section class="mt-5 mb-4">
        <h3 class="text-center mb-4">Cara memesan</h3>
        <div class="row g-4">
            <div class="col-md-4">
                <div class="card h-100 border-0 shadow-sm text-center">
                    <div class="card-body">
                        <div class="fs-1 fw-bold text-primary">1</div>
                        <h5>Pilih tanggal</h5>
                        <p class="text-muted mb-0">Tentukan check-in, check-out, dan jumlah tamu, lalu cari kamar.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card h-100 border-0 shadow-sm text-center">
                    <div class="card-body">
                        <div class="fs-1 fw-bold text-primary">2</div>
                        <h5>Pilih kamar</h5>
                        <p class="text-muted mb-0">Bandingkan tipe kamar, harga, dan fasilitas, lalu lanjut booking.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card h-100 border-0 shadow-sm text-center">
                    <div class="card-body">
                        <div class="fs-1 fw-bold text-primary">3</div>
                        <h5>Tunggu konfirmasi</h5>
                        <p class="text-muted mb-0">Admin memeriksa pesananmu dan mengubah statusnya menjadi dikonfirmasi.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
