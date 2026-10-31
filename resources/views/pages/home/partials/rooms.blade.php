<!-- 4. Rooms Section -->
<section class="py-5 bg-white" id="kamar">
    <div class="container py-4">
        <!-- Header -->
        <div class="row align-items-end mb-5">
            <div class="col-md-8">
                <span class="text-primary-custom fw-semibold small">Kamar Pilihan</span>
                <h2 class="mt-2 mb-3">Temukan Kamar yang Sesuai dengan Kebutuhan Anda</h2>
                <p class="text-muted-custom mb-0">Dari kamar standar hingga suite mewah, semua dirancang untuk memberikan kenyamanan maksimal selama Anda menginap.</p>
            </div>
            <div class="col-md-4 text-md-end mt-3 mt-md-0">
                @if ($searched || $guests)
                    <a href="{{ route('home') }}" class="text-dark text-decoration-none fw-semibold">
                        Lihat Semua Kamar <i class="fa-solid fa-arrow-right ms-1"></i>
                    </a>
                @endif
            </div>
        </div>

        <!-- Cards Grid -->
        <div class="row g-4">
            @forelse ($roomTypes as $type)
                <div class="col-md-6 col-xl-3">
                    <div class="card h-100 room-card border-0">
                        <!-- Image Container with Availability Badge -->
                        <div class="position-relative">
                            @if ($type->image)
                                <img src="{{ asset('storage/' . $type->image) }}" class="room-img-placeholder w-100 object-fit-cover" alt="{{ $type->name }}">
                            @else
                                <img src="https://images.unsplash.com/photo-1611892440504-42a792e24d32?q=80&w=800&auto=format&fit=crop" class="room-img-placeholder w-100 object-fit-cover" alt="{{ $type->name }}">
                            @endif

                            @if ($searched)
                                <div class="position-absolute top-0 end-0 p-2">
                                    @if ($type->available_count > 0)
                                        <span class="badge bg-success rounded-pill px-3 py-2 shadow-sm">{{ $type->available_count }} Tersedia</span>
                                    @else
                                        <span class="badge bg-danger rounded-pill px-3 py-2 shadow-sm">Penuh</span>
                                    @endif
                                </div>
                            @endif
                        </div>

                        <div class="card-body p-4 d-flex flex-column">
                            <h5 class="card-title fw-bold text-dark">{{ $type->name }}</h5>
                            <p class="card-text text-muted-custom small mb-3 flex-grow-1">
                                {{ \Illuminate\Support\Str::limit($type->description, 75) }}
                            </p>
                            <div class="d-flex gap-3 room-meta mb-2">
                                <span><i class="fa-regular fa-user me-1"></i> {{ $type->capacity }} Tamu</span>
                                <span><i class="fa-solid fa-bed me-1"></i> {{ $type->capacity <= 2 ? '1 Queen Bed' : $type->capacity . ' Beds' }}</span>
                            </div>
                        </div>

                        <div class="card-footer room-footer p-4 d-flex justify-content-between align-items-center">
                            <div>
                                <span class="fw-bold text-dark">Rp {{ number_format($type->price_per_night, 0, ',', '.') }}</span>
                                <span class="text-muted-custom small">/ malam</span>
                            </div>
                            <a href="{{ route('rooms.show', array_merge(['roomType' => $type->id], $search)) }}" class="btn btn-sm btn-outline-dark rounded-circle d-flex align-items-center justify-content-center" style="width: 32px; height: 32px;" title="Lihat Detail">
                                <i class="fa-solid fa-arrow-right"></i>
                            </a>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <div class="card border-0 shadow-sm p-5 text-center rounded-4">
                        <i class="fa-solid fa-door-closed display-4 text-muted mb-3"></i>
                        <h5>Tidak ada tipe kamar yang cocok</h5>
                        <p class="text-muted mb-3">Coba atur ulang tanggal pencarian atau kurangi jumlah tamu.</p>
                        <div>
                            <a href="{{ route('home') }}" class="btn btn-primary-custom px-4">Reset Pencarian</a>
                        </div>
                    </div>
                </div>
            @endforelse
        </div>
    </div>
</section>
