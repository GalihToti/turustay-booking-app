@extends('layouts.site')

@section('title', 'Dashboard Admin - TuruStay')

@section('content')
    <h2 class="mb-4">Dashboard Admin</h2>

    <div class="row g-3 mb-4">
        <div class="col-6 col-lg-3">
            <div class="card shadow-sm h-100">
                <div class="card-body">
                    <div class="text-muted small">Tipe kamar</div>
                    <div class="fs-2 fw-semibold">{{ $stats['room_types'] }}</div>
                </div>
            </div>
        </div>
        <div class="col-6 col-lg-3">
            <div class="card shadow-sm h-100">
                <div class="card-body">
                    <div class="text-muted small">Kamar</div>
                    <div class="fs-2 fw-semibold">{{ $stats['rooms'] }}</div>
                </div>
            </div>
        </div>
        <div class="col-6 col-lg-3">
            <div class="card shadow-sm h-100">
                <div class="card-body">
                    <div class="text-muted small">Total booking</div>
                    <div class="fs-2 fw-semibold">{{ $stats['bookings'] }}</div>
                </div>
            </div>
        </div>
        <div class="col-6 col-lg-3">
            <div class="card shadow-sm h-100 border-warning">
                <div class="card-body">
                    <div class="text-muted small">Menunggu konfirmasi</div>
                    <div class="fs-2 fw-semibold text-warning-emphasis">{{ $stats['pending'] }}</div>
                </div>
            </div>
        </div>
    </div>

    <div class="mb-4 d-flex flex-wrap gap-2">
        <a href="{{ url('/admin/bookings') }}" class="btn btn-primary btn-sm">Kelola booking</a>
        <a href="{{ url('/admin/room-types') }}" class="btn btn-outline-primary btn-sm">Tipe kamar</a>
        <a href="{{ url('/admin/rooms') }}" class="btn btn-outline-primary btn-sm">Kamar</a>
        <a href="{{ url('/admin/facilities') }}" class="btn btn-outline-primary btn-sm">Fasilitas</a>
    </div>

    <div class="card shadow-sm">
        <div class="card-header bg-white fw-semibold">Booking terbaru</div>
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th>Kode</th>
                        <th>Tamu</th>
                        <th>Kamar</th>
                        <th>Check-in</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($latestBookings as $booking)
                        <tr>
                            <td>
                                <a href="{{ url('/admin/bookings/' . $booking->id) }}" class="fw-semibold text-decoration-none">
                                    {{ $booking->booking_code }}
                                </a>
                            </td>
                            <td>{{ $booking->user->name }}</td>
                            <td>{{ $booking->room->roomType->name }} ({{ $booking->room->room_number }})</td>
                            <td>{{ \Carbon\Carbon::parse($booking->check_in)->format('d/m/Y') }}</td>
                            <td>@include('bookings._status', ['status' => $booking->status])</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center text-muted py-4">Belum ada booking.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
