@extends('layouts.site')

@section('title', 'Booking Saya - TuruStay')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2 class="mb-0">Booking Saya</h2>
        <a href="{{ route('home') }}" class="btn btn-primary btn-sm">
            <i class="bi bi-plus-lg"></i> Booking baru
        </a>
    </div>

    <div class="card shadow-sm">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th>Kode</th>
                        <th>Kamar</th>
                        <th>Check-in</th>
                        <th>Check-out</th>
                        <th class="text-end">Total</th>
                        <th>Status</th>
                        <th class="text-end">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($bookings as $booking)
                        <tr>
                            <td class="fw-semibold">{{ $booking->booking_code }}</td>
                            <td>
                                {{ $booking->room->roomType->name }}
                                <span class="text-muted small">({{ $booking->room->room_number }})</span>
                            </td>
                            <td>{{ \Carbon\Carbon::parse($booking->check_in)->format('d/m/Y') }}</td>
                            <td>{{ \Carbon\Carbon::parse($booking->check_out)->format('d/m/Y') }}</td>
                            <td class="text-end">Rp {{ number_format($booking->total_price, 0, ',', '.') }}</td>
                            <td>@include('bookings._status', ['status' => $booking->status])</td>
                            <td class="text-end">
                                <a href="{{ route('bookings.show', $booking) }}" class="btn btn-outline-primary btn-sm">Detail</a>
                                @if ($booking->status === 'pending')
                                    <form method="POST" action="{{ route('bookings.cancel', $booking) }}" class="d-inline"
                                          onsubmit="return confirm('Batalkan booking ini?')">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" class="btn btn-outline-danger btn-sm">Batalkan</button>
                                    </form>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center text-muted py-4">Kamu belum punya booking.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="mt-3">
        {{ $bookings->links() }}
    </div>
@endsection
