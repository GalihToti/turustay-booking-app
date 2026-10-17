@extends('layouts.site')

@section('title', 'Booking ' . $booking->booking_code . ' - TuruStay')

@section('content')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('bookings.index') }}">Booking Saya</a></li>
        <li class="breadcrumb-item active" aria-current="page">{{ $booking->booking_code }}</li>
    </ol>
</nav>

<div class="card shadow-sm">
    <div class="card-body">
        <div class="d-flex justify-content-between align-items-start mb-3">
            <div>
                <h3 class="mb-1">{{ $booking->booking_code }}</h3>
                <span class="text-muted"
                    x-data="{ 
                        // Ambil waktu UTC standar dari Laravel
                        date: new Date('{{ $booking->created_at->toISOString() }}') 
                    }"
                    x-text="'Dibuat ' + date.toLocaleString('id-ID', { 
                        day: '2-digit', 
                        month: 'short', 
                        year: 'numeric', 
                        hour: '2-digit', 
                        minute: '2-digit',
                        timeZoneName: 'short'
                    })">
                    {{-- Fallback untuk user yang mematikan JavaScript --}}
                    Dibuat {{ $booking->created_at->format('d M Y H:i') }}
                </span>
            </div>
            @include('bookings._status', ['status' => $booking->status])
        </div>

        <dl class="row mb-0">
            <dt class="col-sm-3">Tipe kamar</dt>
            <dd class="col-sm-9">{{ $booking->room->roomType->name }}</dd>

            <dt class="col-sm-3">Nomor kamar</dt>
            <dd class="col-sm-9">{{ $booking->room->room_number }} (lantai {{ $booking->room->floor }})</dd>

            <dt class="col-sm-3">Check-in</dt>
            <dd class="col-sm-9">{{ \Carbon\Carbon::parse($booking->check_in)->format('d M Y') }}</dd>

            <dt class="col-sm-3">Check-out</dt>
            <dd class="col-sm-9">{{ \Carbon\Carbon::parse($booking->check_out)->format('d M Y') }}</dd>

            <dt class="col-sm-3">Jumlah tamu</dt>
            <dd class="col-sm-9">{{ $booking->guests }} orang</dd>

            <dt class="col-sm-3">Total</dt>
            <dd class="col-sm-9 fw-semibold">Rp {{ number_format($booking->total_price, 0, ',', '.') }}</dd>

            <dt class="col-sm-3">Pembayaran</dt>
            <dd class="col-sm-9">
                @if ($booking->payment_status === 'paid')
                <span class="badge text-bg-success">Lunas</span>
                @else
                <span class="badge text-bg-danger">Belum dibayar</span>
                @endif
            </dd>

            <dt class="col-sm-3">Catatan</dt>
            <dd class="col-sm-9">{{ $booking->notes ?: '-' }}</dd>
        </dl>
    </div>

    <div class="card-footer bg-white d-flex gap-2">
        <a href="{{ route('bookings.index') }}" class="btn btn-outline-secondary">Kembali</a>
        @if ($booking->status === 'pending')
        <form method="POST" action="{{ route('bookings.cancel', $booking) }}"
            onsubmit="return confirm('Batalkan booking ini?')">
            @csrf
            @method('PATCH')
            <button type="submit" class="btn btn-outline-danger">Batalkan booking</button>
        </form>
        @endif
    </div>
</div>
@endsection