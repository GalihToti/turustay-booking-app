@extends('layouts.site')

@section('title', 'Manajemen Booking - TuruStay')

@section('content')
<div>
    <!-- Header & Filter -->
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center mb-4 gap-3">
        <h1 class="h3 mb-0 text-gray-800">Manajemen Booking</h1>
        
        <form method="GET" action="{{ route('admin.bookings.index') }}" class="d-flex align-items-center">
            <label for="statusFilter" class="form-label me-2 mb-0 fw-semibold text-nowrap">Filter Status:</label>
            <select name="status" id="statusFilter" class="form-select form-select-sm" onchange="this.form.submit()">
                <option value="">Semua Status</option>
                @foreach ($statuses as $s)
                    <option value="{{ $s }}" @selected(request('status') === $s)>
                        {{ ucfirst($s) }}
                    </option>
                @endforeach
            </select>
        </form>
    </div>

    <!-- Alert Success -->
    @if (session('success')) 
        <div class="alert alert-success alert-dismissible fade show shadow-sm" role="alert">
            <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <!-- Tabel Data -->
    <div class="card shadow-sm border-0">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover table-striped align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th scope="col" class="px-3">Kode</th>
                            <th scope="col">Tamu</th>
                            <th scope="col">Kamar</th>
                            <th scope="col">Check-in</th>
                            <th scope="col">Check-out</th>
                            <th scope="col">Total</th>
                            <th scope="col">Status</th>
                            <th scope="col">Pembayaran</th>
                            <th scope="col" class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($bookings as $booking)
                            <tr>
                                <td class="px-3 fw-semibold text-secondary">{{ $booking->booking_code }}</td>
                                <td>{{ $booking->user->name }}</td>
                                <td>
                                    {{ $booking->room->room_number }} 
                                    <span class="text-muted small">({{ $booking->room->roomType->name }})</span>
                                </td>
                                <td>{{ $booking->check_in->format('d/m/Y') }}</td>
                                <td>{{ $booking->check_out->format('d/m/Y') }}</td>
                                <td class="fw-semibold text-success">
                                    Rp{{ number_format((float) $booking->total_price, 0, ',', '.') }}
                                </td>
                                <td>
                                    <span class="badge bg-primary rounded-pill px-3 py-2">
                                        {{ ucfirst($booking->status) }}
                                    </span>
                                </td>
                                <td>
                                    @if($booking->payment_status === 'paid')
                                        <span class="badge bg-success rounded-pill px-3 py-2"><i class="bi bi-check-circle me-1"></i> Paid</span>
                                    @else
                                        <span class="badge bg-warning text-dark rounded-pill px-3 py-2"><i class="bi bi-clock me-1"></i> Unpaid</span>
                                    @endif
                                </td>
                                <td class="text-center">
                                    <div class="btn-group" role="group">
                                        <a href="{{ route('admin.bookings.show', $booking) }}" class="btn btn-sm btn-outline-info" title="Detail">
                                            <i class="bi bi-eye"></i> Detail
                                        </a>
                                        <form action="{{ route('admin.bookings.destroy', $booking) }}" method="POST" class="d-inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus booking ini?');">
                                            @csrf 
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-outline-danger" title="Hapus">
                                                <i class="bi bi-trash"></i> Hapus
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="9" class="text-center py-4 text-muted">
                                    <i class="bi bi-inbox fs-2 d-block mb-2"></i>
                                    Belum ada data booking.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Pagination -->
    <div class="d-flex justify-content-end mt-4">
        {{ $bookings->links() }}
    </div>
</div>
@endsection