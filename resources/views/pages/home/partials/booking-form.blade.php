<!-- 3. Booking Engine (Pencarian Tanggal & Kapasitas) -->
<section class="py-4 bg-white" id="booking-form">
    <div class="container">
        <div class="booking-engine p-4">
            <form method="GET" action="{{ route('home') }}" class="row g-3 align-items-end">
                <!-- Check-in -->
                <div class="col-md-3">
                    <label for="check_in" class="form-label text-muted-custom text-uppercase fw-semibold" style="font-size: 0.75rem;">
                        <i class="fa-regular fa-calendar-check me-1 text-primary-custom"></i> Check-in
                    </label>
                    <input type="date" id="check_in" name="check_in" value="{{ $checkIn }}"
                           min="{{ now()->toDateString() }}"
                           class="form-control rounded-3 @error('check_in') is-invalid @enderror">
                    @error('check_in')
                        <div class="text-danger small mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Check-out -->
                <div class="col-md-3">
                    <label for="check_out" class="form-label text-muted-custom text-uppercase fw-semibold" style="font-size: 0.75rem;">
                        <i class="fa-regular fa-calendar-xmark me-1 text-primary-custom"></i> Check-out
                    </label>
                    <input type="date" id="check_out" name="check_out" value="{{ $checkOut }}"
                           min="{{ now()->addDay()->toDateString() }}"
                           class="form-control rounded-3 @error('check_out') is-invalid @enderror">
                    @error('check_out')
                        <div class="text-danger small mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Jumlah Tamu -->
                <div class="col-md-3">
                    <label for="guests" class="form-label text-muted-custom text-uppercase fw-semibold" style="font-size: 0.75rem;">
                        <i class="fa-solid fa-users me-1 text-primary-custom"></i> Jumlah Tamu
                    </label>
                    <input type="number" id="guests" name="guests" value="{{ $guests }}" min="1"
                           placeholder="Semua kapasitas"
                           class="form-control rounded-3 @error('guests') is-invalid @enderror">
                    @error('guests')
                        <div class="text-danger small mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Tombol Aksi -->
                <div class="col-md-3 d-flex gap-2">
                    <button type="submit" class="btn btn-primary-custom w-100 py-2 fw-semibold rounded-3">
                        <i class="fa-solid fa-magnifying-glass me-1"></i> Cari Ketersediaan
                    </button>
                    @if ($searched || $guests)
                        <a href="{{ route('home') }}" class="btn btn-light border d-flex align-items-center justify-content-center rounded-3 px-3" title="Reset Pencarian">
                            <i class="fa-solid fa-arrow-rotate-left"></i>
                        </a>
                    @endif
                </div>
            </form>
        </div>
    </div>
</section>

<!-- Info Ketersediaan jika sedang mencari -->
@if ($searched)
<div class="container my-3 text-center">
    <div class="alert alert-info border-0 rounded-pill shadow-sm d-inline-block px-4 py-2 mb-0">
        <i class="fa-solid fa-circle-info me-2"></i> Menampilkan ketersediaan kamar:
        <strong>{{ $checkInFormatted ?? \Carbon\Carbon::parse($checkIn)->translatedFormat('d M Y') }}</strong> s/d
        <strong>{{ $checkOutFormatted ?? \Carbon\Carbon::parse($checkOut)->translatedFormat('d M Y') }}</strong>
        @if ($guests) &bull; minimal <strong>{{ $guests }} Tamu</strong> @endif
    </div>
</div>
@endif
