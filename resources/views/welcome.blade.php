@extends('layouts.site')

@section('title', 'TuruStay - Kenyamanan Sempurna Menanti Anda')

@section('content')
<style>
    /* 2. Hero Section */
    .hero-wireframe {
        background: linear-gradient(rgba(17, 24, 39, 0.5), rgba(17, 24, 39, 0.7)), 
                    url('https://images.unsplash.com/photo-1542314831-c6a4d14b4fb3?q=80&w=2000&auto=format&fit=crop') center/cover no-repeat;
        min-height: 65vh;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-top: -1rem;
    }

    /* 3. Floating Booking Engine */
    .floating-booking {
        margin-top: -3.5rem;
        position: relative;
        z-index: 20;
    }

    .booking-engine-card {
        border-radius: 0.75rem;
        background: #ffffff;
        box-shadow: 0 1rem 2.5rem rgba(0, 0, 0, 0.08);
        border: 1px solid #e5e7eb;
    }

    /* 4. About Section Photo Grid */
    .photo-grid-main {
        height: 320px;
        border-radius: 0.75rem;
        object-fit: cover;
        width: 100%;
    }

    .photo-grid-sub {
        height: 152px;
        border-radius: 0.75rem;
        object-fit: cover;
        width: 100%;
    }

    /* 5. Rooms Card */
    .room-card-wf {
        border: 1px solid #e5e7eb;
        border-radius: 0.75rem;
        overflow: hidden;
        background: #ffffff;
        transition: transform 0.25s ease, box-shadow 0.25s ease;
    }

    .room-card-wf:hover {
        transform: translateY(-6px);
        box-shadow: 0 1rem 2rem rgba(0, 0, 0, 0.08);
    }

    /* 6. Amenities Circles */
    .amenity-circle {
        width: 68px;
        height: 68px;
        border-radius: 50%;
        background-color: #f3f4f6;
        color: #374151;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.75rem;
        margin: 0 auto 0.75rem auto;
        transition: all 0.3s ease;
    }

    .amenity-item:hover .amenity-circle {
        background-color: #0d6efd;
        color: #ffffff;
        transform: scale(1.08);
    }

    /* Testimonial Card */
    .testimonial-card {
        background: #ffffff;
        border: 1px solid #e5e7eb;
        border-radius: 0.75rem;
    }
</style>

<!-- 2. Hero Section -->
<section class="hero-wireframe text-white text-center px-3">
    <div class="container py-5">
        <h1 class="display-4 fw-bold mb-3 tracking-tight">Kenyamanan Sempurna Menanti Anda</h1>
        <p class="lead text-white-50 mx-auto mb-0" style="max-width: 720px;">
            Temukan perpaduan sempurna antara kemewahan modern dan keramahan lokal di jantung kota.
        </p>
    </div>
</section>

<!-- 3. Floating Booking Engine -->
<div class="container floating-booking mb-5">
    <div class="booking-engine-card p-4">
        <form method="GET" action="{{ route('home') }}" class="row g-3 align-items-end">
            <!-- Check-in -->
            <div class="col-md-3">
                <label for="check_in" class="form-label text-muted text-uppercase fw-semibold" style="font-size: 0.75rem;">
                    <i class="bi bi-calendar-check me-1"></i> Check-in
                </label>
                <div class="border rounded-3 p-1 bg-light">
                    <input type="date" id="check_in" name="check_in" value="{{ $checkIn }}"
                           min="{{ now()->toDateString() }}"
                           class="form-control border-0 bg-transparent @error('check_in') is-invalid @enderror">
                </div>
                @error('check_in')
                    <div class="text-danger small mt-1">{{ $message }}</div>
                @enderror
            </div>

            <!-- Check-out -->
            <div class="col-md-3">
                <label for="check_out" class="form-label text-muted text-uppercase fw-semibold" style="font-size: 0.75rem;">
                    <i class="bi bi-calendar-x me-1"></i> Check-out
                </label>
                <div class="border rounded-3 p-1 bg-light">
                    <input type="date" id="check_out" name="check_out" value="{{ $checkOut }}"
                           min="{{ now()->addDay()->toDateString() }}"
                           class="form-control border-0 bg-transparent @error('check_out') is-invalid @enderror">
                </div>
                @error('check_out')
                    <div class="text-danger small mt-1">{{ $message }}</div>
                @enderror
            </div>

            <!-- Jumlah Tamu -->
            <div class="col-md-3">
                <label for="guests" class="form-label text-muted text-uppercase fw-semibold" style="font-size: 0.75rem;">
                    <i class="bi bi-people me-1"></i> Jumlah Tamu
                </label>
                <div class="border rounded-3 p-1 bg-light">
                    <input type="number" id="guests" name="guests" value="{{ $guests }}" min="1"
                           placeholder="Semua kapasitas"
                           class="form-control border-0 bg-transparent @error('guests') is-invalid @enderror">
                </div>
                @error('guests')
                    <div class="text-danger small mt-1">{{ $message }}</div>
                @enderror
            </div>

            <!-- Tombol Aksi -->
            <div class="col-md-3 d-flex gap-2">
                <button type="submit" class="btn btn-primary btn-lg w-100 py-2 fs-6 rounded-3 fw-semibold">
                    Cari Ketersediaan
                </button>
                @if ($searched || $guests)
                    <a href="{{ route('home') }}" class="btn btn-light btn-lg border d-flex align-items-center justify-content-center rounded-3 px-3" title="Reset">
                        <i class="bi bi-arrow-clockwise"></i>
                    </a>
                @endif
            </div>
        </form>
    </div>
</div>

<!-- Info Ketersediaan jika sedang mencari -->
@if ($searched)
<div class="container mb-4 text-center">
    <div class="alert alert-info border-0 rounded-pill shadow-sm d-inline-block px-4 py-2 mb-0">
        <i class="bi bi-info-circle-fill me-2"></i> Menampilkan ketersediaan kamar:
        <strong>{{ \Carbon\Carbon::parse($checkIn)->format('d M Y') }}</strong> s/d
        <strong>{{ \Carbon\Carbon::parse($checkOut)->format('d M Y') }}</strong>
        @if ($guests) &bull; minimal <strong>{{ $guests }} Tamu</strong> @endif
    </div>
</div>
@endif

<!-- 4. About Section -->
<section class="py-5" id="tentang">
    <div class="container py-4">
        <div class="row align-items-center g-5">
            <div class="col-lg-6">
                <h6 class="text-primary text-uppercase fw-bold tracking-wider mb-2" style="font-size: 0.85rem;">Tentang Turustay</h6>
                <h2 class="display-6 fw-bold text-gray-900 mb-4" style="color: #111827;">Lebih dari sekadar tempat menginap</h2>
                <p class="text-secondary leading-relaxed mb-3">
                    Turustay didesain untuk memberikan pengalaman menginap yang tak terlupakan. Filosofi kami berpusat pada kenyamanan maksimal, layanan personal, dan integrasi harmonis dengan budaya lokal.
                </p>
                <p class="text-secondary leading-relaxed mb-4">
                    Baik Anda bepergian untuk bisnis maupun rekreasi, fasilitas kelas dunia kami memastikan setiap kebutuhan Anda terpenuhi sejak momen Anda melangkah masuk ke lobi kami.
                </p>
                <a href="#kamar" class="text-primary fw-semibold text-decoration-none d-inline-flex align-items-center">
                    Pelajari lebih lanjut <i class="bi bi-arrow-right ms-2"></i>
                </a>
            </div>
            <div class="col-lg-6">
                <div class="row g-3">
                    <div class="col-6">
                        <img src="https://images.unsplash.com/photo-1582719478250-c89cae4dc85b?q=80&w=800&auto=format&fit=crop" 
                             class="photo-grid-main shadow-sm" alt="Hotel Interior">
                    </div>
                    <div class="col-6 d-flex flex-column gap-3">
                        <img src="https://images.unsplash.com/photo-1540555700478-4be289fbecef?q=80&w=800&auto=format&fit=crop" 
                             class="photo-grid-sub shadow-sm" alt="Kolam Renang">
                        <img src="https://images.unsplash.com/photo-1578683010236-d716f9a3f461?q=80&w=800&auto=format&fit=crop" 
                             class="photo-grid-sub shadow-sm" alt="Kamar Hotel">
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- 5. Rooms Grid -->
<section class="py-5 bg-white border-top border-bottom" id="kamar">
    <div class="container py-4">
        <div class="text-center mb-5">
            <h2 class="fw-bold text-gray-900 mb-2" style="color: #111827;">Pilihan Kamar</h2>
            <p class="text-secondary mx-auto" style="max-width: 620px;">
                Ruang istirahat yang dirancang dengan elegan untuk memenuhi segala kebutuhan Anda.
            </p>
        </div>

        <div class="row g-4">
            @forelse ($roomTypes as $type)
                <div class="col-md-6 col-lg-4">
                    <div class="room-card-wf h-100 d-flex flex-column">
                        <!-- Foto Kamar -->
                        <div class="position-relative" style="height: 210px; background-color: #e5e7eb;">
                            @if ($type->image)
                                <img src="{{ asset('storage/' . $type->image) }}" class="w-100 h-100 object-fit-cover" alt="{{ $type->name }}">
                            @else
                                <img src="https://images.unsplash.com/photo-1611892440504-42a792e24d32?q=80&w=800&auto=format&fit=crop" class="w-100 h-100 object-fit-cover" alt="{{ $type->name }}">
                            @endif

                            @if ($searched)
                                <div class="position-absolute top-0 end-0 p-3">
                                    @if ($type->available_count > 0)
                                        <span class="badge bg-success rounded-pill px-3 py-2 shadow-sm">{{ $type->available_count }} Tersedia</span>
                                    @else
                                        <span class="badge bg-danger rounded-pill px-3 py-2 shadow-sm">Penuh</span>
                                    @endif
                                </div>
                            @endif
                        </div>

                        <!-- Konten Kamar -->
                        <div class="p-4 d-flex flex-column flex-grow-1">
                            <h4 class="fw-bold text-dark mb-1">{{ $type->name }}</h4>
                            <p class="text-muted small mb-3">
                                <i class="bi bi-people-fill text-secondary me-1"></i> Maks. {{ $type->capacity }} Tamu
                            </p>

                            <p class="text-secondary small mb-3 flex-grow-1">
                                {{ \Illuminate\Support\Str::limit($type->description, 80) }}
                            </p>

                            <!-- Fasilitas -->
                            <div class="d-flex flex-wrap gap-1 mb-4">
                                @forelse ($type->facilities as $facility)
                                    <span class="badge bg-light text-secondary border fw-normal px-2 py-1">
                                        @if ($facility->icon) <i class="bi {{ $facility->icon }} me-1"></i> @endif
                                        {{ $facility->name }}
                                    </span>
                                @empty
                                    <span class="text-muted small">Standard amenities</span>
                                @endforelse
                            </div>

                            <!-- Harga & Aksi -->
                            <div class="pt-3 border-top d-flex justify-content-between align-items-center">
                                <div>
                                    <span class="text-muted small d-block">Mulai dari</span>
                                    <span class="fw-bold text-dark fs-5">
                                        Rp {{ number_format($type->price_per_night, 0, ',', '.') }}
                                        <span class="text-muted fw-normal" style="font-size: 0.8rem;">/malam</span>
                                    </span>
                                </div>
                                <a href="{{ route('rooms.show', array_merge(['roomType' => $type->id], $search)) }}"
                                   class="btn btn-outline-primary rounded-2 px-3 py-2 text-sm fw-medium">
                                    Lihat Kamar
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <div class="card border-0 shadow-sm p-5 text-center rounded-4">
                        <i class="bi bi-door-closed display-4 text-muted mb-3"></i>
                        <h5>Tidak ada tipe kamar yang cocok</h5>
                        <p class="text-muted mb-3">Coba atur ulang tanggal atau kurangi jumlah tamu.</p>
                        <div>
                            <a href="{{ route('home') }}" class="btn btn-primary btn-sm px-4">Reset Pencarian</a>
                        </div>
                    </div>
                </div>
            @endforelse
        </div>

        @if ($searched || $guests)
        <div class="text-center mt-5">
            <a href="{{ route('home') }}" class="text-dark fw-semibold text-decoration-underline">
                Lihat Semua Tipe Kamar
            </a>
        </div>
        @endif
    </div>
</section>

<!-- 6. Amenities Section -->
<section class="py-5" id="fasilitas">
    <div class="container py-4 text-center">
        <h2 class="fw-bold text-gray-900 mb-5" style="color: #111827;">Fasilitas Unggulan</h2>
        <div class="row g-4 justify-content-center">
            <div class="col-6 col-md-auto amenity-item px-md-4">
                <div class="amenity-circle">
                    <i class="bi bi-water"></i>
                </div>
                <h6 class="fw-semibold text-dark mb-0">Kolam Renang</h6>
            </div>
            <div class="col-6 col-md-auto amenity-item px-md-4">
                <div class="amenity-circle">
                    <i class="bi bi-stars"></i>
                </div>
                <h6 class="fw-semibold text-dark mb-0">Spa & Pijat</h6>
            </div>
            <div class="col-6 col-md-auto amenity-item px-md-4">
                <div class="amenity-circle">
                    <i class="bi bi-cup-hot"></i>
                </div>
                <h6 class="fw-semibold text-dark mb-0">Restoran</h6>
            </div>
            <div class="col-6 col-md-auto amenity-item px-md-4">
                <div class="amenity-circle">
                    <i class="bi bi-heart-pulse"></i>
                </div>
                <h6 class="fw-semibold text-dark mb-0">Pusat Kebugaran</h6>
            </div>
            <div class="col-6 col-md-auto amenity-item px-md-4">
                <div class="amenity-circle">
                    <i class="bi bi-headset"></i>
                </div>
                <h6 class="fw-semibold text-dark mb-0">Layanan 24 Jam</h6>
            </div>
        </div>
    </div>
</section>

<!-- 7. Testimonials Section -->
<section class="py-5 bg-light border-top border-bottom" id="testimoni">
    <div class="container py-4">
        <h2 class="fw-bold text-center text-gray-900 mb-5" style="color: #111827;">Apa Kata Tamu Kami</h2>
        <div class="row g-4">
            <!-- Review 1 -->
            <div class="col-md-4">
                <div class="testimonial-card p-4 h-100 d-flex flex-column shadow-sm">
                    <div class="text-dark mb-3">
                        <i class="bi bi-star-fill text-warning"></i>
                        <i class="bi bi-star-fill text-warning"></i>
                        <i class="bi bi-star-fill text-warning"></i>
                        <i class="bi bi-star-fill text-warning"></i>
                        <i class="bi bi-star-fill text-warning"></i>
                    </div>
                    <p class="text-secondary fst-italic mb-4 flex-grow-1">
                        "Pelayanan luar biasa! Kamar sangat bersih dan interiornya minimalis modern. Lokasi juga sangat strategis untuk jalan-jalan di pusat kota."
                    </p>
                    <div class="d-flex align-items-center gap-3 pt-3 border-top">
                        <div class="rounded-circle bg-secondary-subtle d-flex align-items-center justify-content-center text-secondary fw-bold" style="width: 42px; height: 42px;">BS</div>
                        <div>
                            <h6 class="fw-bold text-dark mb-0">Budi Santoso</h6>
                            <small class="text-muted">Tamu Keluarga</small>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Review 2 -->
            <div class="col-md-4">
                <div class="testimonial-card p-4 h-100 d-flex flex-column shadow-sm">
                    <div class="text-dark mb-3">
                        <i class="bi bi-star-fill text-warning"></i>
                        <i class="bi bi-star-fill text-warning"></i>
                        <i class="bi bi-star-fill text-warning"></i>
                        <i class="bi bi-star-fill text-warning"></i>
                        <i class="bi bi-star-fill text-warning"></i>
                    </div>
                    <p class="text-secondary fst-italic mb-4 flex-grow-1">
                        "Sarapannya juara! Banyak variasi makanan lokal dan western. Kolam renang di rooftop menawarkan pemandangan sunset yang sangat indah."
                    </p>
                    <div class="d-flex align-items-center gap-3 pt-3 border-top">
                        <div class="rounded-circle bg-secondary-subtle d-flex align-items-center justify-content-center text-secondary fw-bold" style="width: 42px; height: 42px;">SA</div>
                        <div>
                            <h6 class="fw-bold text-dark mb-0">Siti Aminah</h6>
                            <small class="text-muted">Tamu Pasangan</small>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Review 3 -->
            <div class="col-md-4">
                <div class="testimonial-card p-4 h-100 d-flex flex-column shadow-sm">
                    <div class="text-dark mb-3">
                        <i class="bi bi-star-fill text-warning"></i>
                        <i class="bi bi-star-fill text-warning"></i>
                        <i class="bi bi-star-fill text-warning"></i>
                        <i class="bi bi-star-fill text-warning"></i>
                        <i class="bi bi-star-fill text-warning"></i>
                    </div>
                    <p class="text-secondary fst-italic mb-4 flex-grow-1">
                        "Sangat cocok untuk perjalanan bisnis. WiFi super cepat, meja kerja nyaman di dalam kamar, dan proses check-in sangat efisien."
                    </p>
                    <div class="d-flex align-items-center gap-3 pt-3 border-top">
                        <div class="rounded-circle bg-secondary-subtle d-flex align-items-center justify-content-center text-secondary fw-bold" style="width: 42px; height: 42px;">RP</div>
                        <div>
                            <h6 class="fw-bold text-dark mb-0">Reza Pahlevi</h6>
                            <small class="text-muted">Perjalanan Bisnis</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- 8. Location & Access Section -->
<section class="py-5" id="lokasi">
    <div class="container py-4">
        <div class="row g-5 align-items-center">
            <!-- Info Lokasi -->
            <div class="col-lg-6">
                <h2 class="fw-bold text-gray-900 mb-4" style="color: #111827;">Lokasi & Akses</h2>
                <div class="mb-4">
                    <h5 class="fw-bold text-dark mb-2">Turustay Hotel</h5>
                    <p class="text-secondary mb-2 d-flex align-items-start gap-2">
                        <i class="bi bi-geo-alt text-secondary fs-5"></i>
                        Jl. Jenderal Sudirman No. 123, Pusat Kota, Daerah Bisnis, Kode Pos 12345
                    </p>
                    <p class="text-secondary mb-2 d-flex align-items-center gap-2">
                        <i class="bi bi-telephone text-secondary fs-5"></i> +62 21 555 0123
                    </p>
                    <p class="text-secondary d-flex align-items-center gap-2">
                        <i class="bi bi-envelope text-secondary fs-5"></i> hello@turustay.com
                    </p>
                </div>

                <h6 class="fw-bold text-dark mb-3 border-bottom pb-2">Jarak Akses Terdekat</h6>
                <ul class="list-unstyled d-flex flex-column gap-3 mb-0">
                    <li class="d-flex justify-content-between align-items-center text-secondary">
                        <span><i class="bi bi-airplane me-2"></i> Bandara Internasional</span>
                        <span class="badge bg-light text-dark border">15 KM (30 Menit)</span>
                    </li>
                    <li class="d-flex justify-content-between align-items-center text-secondary">
                        <span><i class="bi bi-train-front me-2"></i> Stasiun Kereta Pusat</span>
                        <span class="badge bg-light text-dark border">2.5 KM (10 Menit)</span>
                    </li>
                    <li class="d-flex justify-content-between align-items-center text-secondary">
                        <span><i class="bi bi-bag me-2"></i> Mall Pusat Kota</span>
                        <span class="badge bg-light text-dark border">500 M (Jalan Kaki)</span>
                    </li>
                </ul>
            </div>

            <!-- Map Placeholder / Embed -->
            <div class="col-lg-6">
                <div class="rounded-3 overflow-hidden border shadow-sm bg-light d-flex align-items-center justify-content-center" style="height: 380px;">
                    <div class="text-center text-muted p-4">
                        <i class="bi bi-map display-4 d-block mb-3 text-secondary"></i>
                        <h5 class="fw-bold text-dark mb-1">Google Maps Embed Placeholder</h5>
                        <p class="small text-secondary mb-3">Turustay Hotel - Pusat Kota</p>
                        <a href="https://maps.google.com" target="_blank" class="btn btn-outline-dark btn-sm rounded-2 px-3">
                            <i class="bi bi-box-arrow-up-right me-1"></i> Buka di Google Maps
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
