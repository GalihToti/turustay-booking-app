@extends('layouts.site')

@section('title', 'Dashboard Admin - TuruStay')

@section('content')
<div class="container mt-4 mb-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0 text-gray-800">Booking #{{ $booking->booking_code }}</h1>
        <a href="{{ route('admin.bookings.index') }}" class="btn btn-outline-secondary">
            <i class="bi bi-arrow-left"></i> Kembali
        </a>
    </div>

    @if (session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    <div class="row">
        <!-- Detail Booking -->
        <div class="col-md-7 mb-4">
            <div class="card shadow-sm h-100">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">Informasi Booking</h5>
                </div>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <span class="text-muted">Tamu</span>
                        <span class="fw-semibold">{{ $booking->user->name }}</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <span class="text-muted">Kamar</span>
                        <span class="fw-semibold">{{ $booking->room->room_number }} ({{ $booking->room->roomType->name }})</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <span class="text-muted">Jadwal Inap</span>
                        <span class="fw-semibold">{{ $booking->check_in->format('d/m/Y') }} — {{ $booking->check_out->format('d/m/Y') }}</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <span class="text-muted">Jumlah Tamu</span>
                        <span class="fw-semibold">{{ $booking->guests }} Orang</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <span class="text-muted">Total Tagihan</span>
                        <span class="fw-bold text-success">Rp{{ number_format((float) $booking->total_price, 0, ',', '.') }}</span>
                    </li>
                    <li class="list-group-item">
                        <span class="text-muted d-block mb-1">Catatan</span>
                        <p class="mb-0">{{ $booking->notes ?? '-' }}</p>
                    </li>
                </ul>
            </div>
        </div>

        <!-- Form Update Status -->
        <div class="col-md-5 mb-4">
            <div class="card shadow-sm h-100">
                <div class="card-header bg-light">
                    <h5 class="mb-0">Pembaruan Status</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.bookings.update', $booking) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label for="status" class="form-label fw-semibold">Status Booking</label>
                            <select name="status" id="status" class="form-select">
                                @foreach ($statuses as $s)
                                <option value="{{ $s }}" @selected(old('status', $booking->status) === $s)>
                                    {{ ucfirst($s) }}
                                </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-4">
                            <label for="payment_status" class="form-label fw-semibold">Status Pembayaran</label>
                            <select name="payment_status" id="payment_status" class="form-select">
                                @foreach (['unpaid', 'paid'] as $p)
                                <option value="{{ $p }}" @selected(old('payment_status', $booking->payment_status) === $p)>
                                    {{ ucfirst($p) }}
                                </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary">
                                Simpan Perubahan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection