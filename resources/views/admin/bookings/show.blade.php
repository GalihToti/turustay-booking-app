<h1>Booking {{ $booking->booking_code }}</h1>
@if (session('success')) <p style="color:green">{{ session('success') }}</p> @endif

<p>Tamu: {{ $booking->user->name }}</p>
<p>Kamar: {{ $booking->room->room_number }} ({{ $booking->room->roomType->name }})</p>
<p>Check-in: {{ $booking->check_in->format('d/m/Y') }} | Check-out: {{ $booking->check_out->format('d/m/Y') }}</p>
<p>Jumlah tamu: {{ $booking->guests }}</p>
<p>Total: Rp{{ number_format((float) $booking->total_price, 0, ',', '.') }}</p>
<p>Catatan: {{ $booking->notes ?? '-' }}</p>

<form action="{{ route('admin.bookings.update', $booking) }}" method="POST">
    @csrf @method('PUT')
    <label>Status</label>
    <select name="status">
        @foreach ($statuses as $s)
        <option value="{{ $s }}" @selected(old('status', $booking->status) === $s)>{{ $s }}</option>
        @endforeach
    </select>
    <label>Pembayaran</label>
    <select name="payment_status">
        @foreach (['unpaid', 'paid'] as $p)
        <option value="{{ $p }}" @selected(old('payment_status', $booking->payment_status) === $p)>{{ $p }}</option>
        @endforeach
    </select>
    <button type="submit">Perbarui</button>
</form>

<a href="{{ route('admin.bookings.index') }}">Kembali</a>