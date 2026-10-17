<h1>Manajemen Booking</h1>
@if (session('success')) <p style="color:green">{{ session('success') }}</p> @endif

<form method="GET" action="{{ route('admin.bookings.index') }}">
    <select name="status" onchange="this.form.submit()">
        <option value="">Semua status</option>
        @foreach ($statuses as $s)
        <option value="{{ $s }}" @selected(request('status')===$s)>{{ $s }}</option>
        @endforeach
    </select>
</form>

<table border="1" cellpadding="8">
    <tr>
        <th>Kode</th>
        <th>Tamu</th>
        <th>Kamar</th>
        <th>Check-in</th>
        <th>Check-out</th>
        <th>Total</th>
        <th>Status</th>
        <th>Bayar</th>
        <th>Aksi</th>
    </tr>
    @forelse ($bookings as $booking)
    <tr>
        <td>{{ $booking->booking_code }}</td>
        <td>{{ $booking->user->name }}</td>
        <td>{{ $booking->room->room_number }} ({{ $booking->room->roomType->name }})</td>
        <td>{{ $booking->check_in->format('d/m/Y') }}</td>
        <td>{{ $booking->check_out->format('d/m/Y') }}</td>
        <td>Rp{{ number_format((float) $booking->total_price, 0, ',', '.') }}</td>
        <td>{{ $booking->status }}</td>
        <td>{{ $booking->payment_status }}</td>
        <td>
            <a href="{{ route('admin.bookings.show', $booking) }}">Detail</a> |
            <form action="{{ route('admin.bookings.destroy', $booking) }}" method="POST" style="display:inline"
                onsubmit="return confirm('Hapus booking ini?')">
                @csrf @method('DELETE')
                <button type="submit">Hapus</button>
            </form>
        </td>
    </tr>
    @empty
    <tr>
        <td colspan="9">Belum ada booking.</td>
    </tr>
    @endforelse
</table>
{{ $bookings->links() }}