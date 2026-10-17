<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class BookingController extends Controller
{
    private const STATUSES = ['pending', 'confirmed', 'checked_in', 'completed', 'cancelled'];

    public function index(Request $request)
    {
        $bookings = Booking::with(['user', 'room.roomType'])
            ->when($request->filled('status'), fn ($q) => $q->where('status', $request->status))
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('admin.bookings.index', ['bookings' => $bookings, 'statuses' => self::STATUSES]);
    }

    public function show(Booking $booking)
    {
        $booking->load(['user', 'room.roomType']);
        return view('admin.bookings.show', ['booking' => $booking, 'statuses' => self::STATUSES]);
    }

    public function update(Request $request, Booking $booking)
    {
        $booking->update($request->validate([
            'status'         => ['required', Rule::in(self::STATUSES)],
            'payment_status' => ['required', Rule::in(['unpaid', 'paid'])],
        ]));

        return redirect()->route('admin.bookings.show', $booking)->with('success', 'Status booking berhasil diperbarui.');
    }

    public function destroy(Booking $booking)
    {
        $booking->delete();
        return redirect()->route('admin.bookings.index')->with('success', 'Booking berhasil dihapus.');
    }
}