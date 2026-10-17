@extends('layouts.site')

@section('title', 'Konfirmasi Booking - TuruStay')

@section('content')
    <h2 class="mb-4">Konfirmasi Booking</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="row g-4">
        <div class="col-lg-7">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h5 class="card-title">{{ $roomType->name }}</h5>
                    <dl class="row mb-0">
                        <dt class="col-sm-4">Check-in</dt>
                        <dd class="col-sm-8">{{ \Carbon\Carbon::parse($checkIn)->format('d M Y') }}</dd>

                        <dt class="col-sm-4">Check-out</dt>
                        <dd class="col-sm-8">{{ \Carbon\Carbon::parse($checkOut)->format('d M Y') }}</dd>

                        <dt class="col-sm-4">Lama menginap</dt>
                        <dd class="col-sm-8">{{ $nights }} malam</dd>

                        <dt class="col-sm-4">Jumlah tamu</dt>
                        <dd class="col-sm-8">{{ $guests }} orang</dd>

                        <dt class="col-sm-4">Harga per malam</dt>
                        <dd class="col-sm-8">Rp {{ number_format($roomType->price_per_night, 0, ',', '.') }}</dd>

                        <dt class="col-sm-4">Total</dt>
                        <dd class="col-sm-8 fs-5 fw-semibold">Rp {{ number_format($total, 0, ',', '.') }}</dd>
                    </dl>
                </div>
            </div>
        </div>

        <div class="col-lg-5">
            <div class="card shadow-sm">
                <div class="card-body">
                    @if ($availableCount > 0)
                        <form method="POST" action="{{ route('bookings.store') }}">
                            @csrf
                            <input type="hidden" name="room_type_id" value="{{ $roomType->id }}">
                            <input type="hidden" name="check_in" value="{{ $checkIn }}">
                            <input type="hidden" name="check_out" value="{{ $checkOut }}">
                            <input type="hidden" name="guests" value="{{ $guests }}">

                            <div class="mb-3">
                                <label class="form-label" for="notes">Catatan (opsional)</label>
                                <textarea id="notes" name="notes" rows="4" maxlength="500"
                                          class="form-control @error('notes') is-invalid @enderror"
                                          placeholder="Contoh: mohon kamar lantai bawah">{{ old('notes') }}</textarea>
                                @error('notes')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="d-grid gap-2">
                                <button type="submit" class="btn btn-primary">Pesan sekarang</button>
                                <a href="{{ route('rooms.show', ['roomType' => $roomType->id, 'check_in' => $checkIn, 'check_out' => $checkOut, 'guests' => $guests]) }}"
                                   class="btn btn-outline-secondary">Kembali</a>
                            </div>
                        </form>
                    @else
                        <div class="alert alert-danger">Maaf, kamar tipe ini penuh pada tanggal yang kamu pilih.</div>
                        <a href="{{ route('home') }}" class="btn btn-outline-secondary w-100">Cari tanggal lain</a>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
