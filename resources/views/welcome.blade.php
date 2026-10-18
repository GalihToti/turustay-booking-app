@extends('layouts.site')

@section('title', 'TuruStay - Temukan Kenyamanan Sempurna')

@section('content')
<style>
    .hero-section {
        /* Ganti URL gambar dengan gambar asli hotel Anda jika ada */
        background: linear-gradient(rgba(30, 30, 30, 0.4), rgba(20, 20, 20, 0.7)), url('https://images.unsplash.com/photo-1542314831-c6a4d14b4fb3?q=80&w=2000&auto=format&fit=crop') center/cover no-repeat;
        min-height: 60vh;
        display: flex;
        align-items: center;
        border-radius: 0 0 2rem 2rem;
        margin-top: -1rem;
        /* Menyesuaikan jika ada padding dari layout utama */
    }

    .floating-search {
        margin-top: -4rem;
        z-index: 10;
        position: relative;
    }

    .room-card {
        transition: all 0.3s ease;
        border: 1px solid rgba(0, 0, 0, 0.05);
    }

    .room-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 1rem 3rem rgba(0, 0, 0, 0.1) !important;
    }

    .step-number {
        width: 60px;
        height: 60px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 50%;
        background-color: #f0e9e1;
        color: #8c6b4a;
        /* Warna cokelat/emas hangat */
        margin: 0 auto 1rem;
    }

    .btn-brand {
        background-color: #2c3e50;
        color: #fff;
        border: none;
    }

    .btn-brand:hover {
        background-color: #1a252f;
        color: #fff;
    }
</style>

<!-- Hero Section -->
<div class="hero-section">
    <div class="container text-center text-white pb-5">
        <h1 class="display-4 fw-bold mb-3">Istirahat Tenang, Pesan Mudah.</h1>
        <p class="lead fs-5 text-white-50 mb-0">Temukan kamar ideal Anda untuk pengalaman menginap yang tak terlupakan di TuruStay.</p>
    </div>
</div>

<!-- Floating Search Bar -->
<div class="container floating-search mb-5">
    <div class="card shadow-lg border-0 rounded-4 p-3 p-md-4 bg-white">
        <form method="GET" action="{{ route('home') }}" class="row g-3 align-items-center">

            <div class="col-md-3">
                <div class="form-floating">
                    <input type="date" id="check_in" name="check_in" value="{{ $checkIn }}"
                        min="{{ now()->toDateString() }}"
                        class="form-control bg-light border-0 @error('check_in') is-invalid @enderror">
                    <label for="check_in" class="text-muted"><i class="bi bi-calendar-check me-1"></i> Check-in</label>
                    @error('check_in')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="col-md-3">
                <div class="form-floating">
                    <input type="date" id="check_out" name="check_out" value="{{ $checkOut }}"
                        min="{{ now()->addDay()->toDateString() }}"
                        class="form-control bg-light border-0 @error('check_out') is-invalid @enderror">
                    <label for="check_out" class="text-muted"><i class="bi bi-calendar-x me-1"></i> Check-out</label>
                    @error('check_out')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="col-md-3">
                <div class="form-floating">
                    <input type="number" id="guests" name="guests" value="{{ $guests }}" min="1"
                        placeholder="Semua"
                        class="form-control bg-light border-0 @error('guests') is-invalid @enderror">
                    <label for="guests" class="text-muted"><i class="bi bi-people me-1"></i> Jumlah Tamu</label>
                    @error('guests')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="col-md-3 d-flex gap-2 h-100">
                <button type="submit" class="btn btn-brand btn-lg w-100 h-100 rounded-3 shadow-sm" style="min-height: 58px;">
                    Cari Kamar
                </button>
                @if ($searched || $guests)
                <a href="{{ route('home') }}" class="btn btn-light btn-lg border h-100 d-flex align-items-center rounded-3" title="Reset Pencarian">
                    <i class="bi bi-arrow-clockwise"></i>
                </a>
                @endif
            </div>
        </form>
    </div>
</div>

<div class="container mb-5">
    <!-- Info Ketersediaan -->
    @if ($searched)
    <div class="text-center mb-5">
        <span class="badge bg-light text-dark border px-4 py-2 fs-6 rounded-pill shadow-sm">
            <i class="bi bi-search me-2"></i> Ketersediaan kamar:
            <span class="fw-bold">{{ \Carbon\Carbon::parse($checkIn)->format('d M Y') }}</span> —
            <span class="fw-bold">{{ \Carbon\Carbon::parse($checkOut)->format('d M Y') }}</span>
        </span>
    </div>
    @endif

    <!-- Daftar Kamar -->
    <div class="d-flex justify-content-between align-items-end mb-4">
        <h2 class="mb-0">Kamar Pilihan Kami</h2>
    </div>

    <div class="row g-4">
        @forelse ($roomTypes as $type)
        <div class="col-md-6 col-lg-4">
            <div class="card room-card h-100 shadow-sm border-0 rounded-4 overflow-hidden bg-white">
                <!-- Placeholder Gambar Kamar (Bisa diganti dengan $type->image jika ada di database) -->
                <div class="position-relative">
                    <img src="https://images.unsplash.com/photo-1611892440504-42a792e24d32?q=80&w=800&auto=format&fit=crop" class="card-img-top object-fit-cover" alt="{{ $type->name }}" style="height: 220px;">
                    @if ($searched)
                    <div class="position-absolute top-0 end-0 p-3">
                        @if ($type->available_count > 0)
                        <span class="badge bg-success shadow">{{ $type->available_count }} Tersedia</span>
                        @else
                        <span class="badge bg-danger shadow">Penuh</span>
                        @endif
                    </div>
                    @endif
                </div>

                <div class="card-body d-flex flex-column p-4">
                    <div class="d-flex justify-content-between align-items-start mb-2">
                        <h4 class="card-title hotel-font fw-bold mb-0">{{ $type->name }}</h4>
                    </div>

                    <p class="text-muted small mb-3">
                        <i class="bi bi-person-fill text-secondary"></i> Maks. {{ $type->capacity }} tamu
                    </p>

                    <p class="card-text text-secondary" style="font-size: 0.95rem;">
                        {{ \Illuminate\Support\Str::limit($type->description, 80) }}
                    </p>

                    <div class="mb-4 d-flex flex-wrap gap-1">
                        @foreach ($type->facilities as $facility)
                        <span class="badge rounded-pill text-bg-light border text-secondary fw-normal px-2 py-1">
                            {{ $facility->name }}
                        </span>
                        @endforeach
                    </div>

                    <div class="mt-auto pt-3 border-top d-flex justify-content-between align-items-center">
                        <div>
                            <span class="text-muted small d-block">Mulai dari</span>
                            <div class="fs-5 fw-bold text-dark">
                                Rp {{ number_format($type->price_per_night, 0, ',', '.') }}
                                <span class="text-muted fw-normal" style="font-size: 0.8rem;">/ malam</span>
                            </div>
                        </div>
                        <a href="{{ route('rooms.show', array_merge(['roomType' => $type->id], $search)) }}"
                            class="btn btn-outline-dark rounded-pill px-4">Detail</a>
                    </div>
                </div>
            </div>
        </div>
        @empty
        <div class="col-12">
            <div class="alert bg-white border shadow-sm rounded-4 text-center py-5">
                <i class="bi bi-door-closed fs-1 text-muted d-block mb-3"></i>
                <h5 class="hotel-font">Tidak ada kamar yang sesuai</h5>
                <p class="text-muted mb-0">Coba ubah tanggal check-in/check-out atau jumlah tamu Anda.</p>
            </div>
        </div>
        @endforelse
    </div>
</div>

<!-- Section: Kenapa TuruStay -->
<section class="py-5 mt-5 bg-white border-top border-bottom">
    <div class="container py-4">
        <div class="text-center mb-5">
            <h2 class="mb-3">Kenapa Memilih TuruStay?</h2>
            <p class="text-muted mx-auto" style="max-width: 600px;">Kami memastikan pengalaman menginap Anda nyaman, aman, dan tanpa hambatan dari awal pemesanan hingga check-out.</p>
        </div>

        <div class="row g-4 text-center">
            <div class="col-md-4">
                <div class="p-3">
                    <div class="d-inline-block bg-light p-4 rounded-circle mb-3 shadow-sm">
                        <i class="bi bi-lightning-charge-fill fs-2" style="color: #8c6b4a;"></i>
                    </div>
                    <h5 class="fw-bold">Pemesanan Instan</h5>
                    <p class="text-muted">Pilih tanggal, temukan kamar yang tepat, dan amankan pesanan Anda hanya dalam hitungan menit.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="p-3">
                    <div class="d-inline-block bg-light p-4 rounded-circle mb-3 shadow-sm">
                        <i class="bi bi-shield-check fs-2" style="color: #8c6b4a;"></i>
                    </div>
                    <h5 class="fw-bold">Ketersediaan Akurat</h5>
                    <p class="text-muted">Sistem pintar kami mencegah pemesanan ganda. Kamar yang Anda lihat adalah kamar yang pasti tersedia.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="p-3">
                    <div class="d-inline-block bg-light p-4 rounded-circle mb-3 shadow-sm">
                        <i class="bi bi-cup-hot-fill fs-2" style="color: #8c6b4a;"></i>
                    </div>
                    <h5 class="fw-bold">Transparansi Fasilitas</h5>
                    <p class="text-muted">Dari kecepatan WiFi hingga menu sarapan, semua detail terlihat jelas sebelum Anda memesan.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Section: Cara Memesan -->
<section class="py-5 mb-4">
    <div class="container py-4">
        <h2 class="text-center mb-5">Langkah Mudah Menginap</h2>
        <div class="row g-4 position-relative">

            <div class="col-md-4">
                <div class="card h-100 border-0 bg-transparent text-center px-2">
                    <div class="step-number fs-3 fw-bold shadow-sm">1</div>
                    <h5 class="fw-bold">Tentukan Tanggal</h5>
                    <p class="text-muted mb-0">Masukkan jadwal check-in, check-out, serta jumlah tamu yang akan menginap.</p>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card h-100 border-0 bg-transparent text-center px-2">
                    <div class="step-number fs-3 fw-bold shadow-sm">2</div>
                    <h5 class="fw-bold">Pilih Kamar Impian</h5>
                    <p class="text-muted mb-0">Bandingkan ukuran, fasilitas, dan harga. Temukan tipe kamar yang paling sesuai dengan kebutuhan Anda.</p>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card h-100 border-0 bg-transparent text-center px-2">
                    <div class="step-number fs-3 fw-bold shadow-sm">3</div>
                    <h5 class="fw-bold">Konfirmasi & Bersantai</h5>
                    <p class="text-muted mb-0">Selesaikan pemesanan dan tunggu konfirmasi otomatis. Anda siap untuk menikmati istirahat yang tenang.</p>
                </div>
            </div>

        </div>
    </div>
</section>
@endsection