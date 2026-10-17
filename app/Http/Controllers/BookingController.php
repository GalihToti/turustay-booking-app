<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\RoomType;
use App\Services\RoomAvailability;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class BookingController extends Controller
{
    public function index() {
        // Riwayat milik user yang login
        $bookings = Booking::with('room.roomType')
            ->where('user_id', auth()->id())
            ->latest()
            ->paginate(10);
        return view('bookings.index', compact('bookings'));
    }

    // form konfirmasi booking
    public function create(Request $request) {
        $data = $request->validate($this->rules());
        $roomType = RoomType::findOrFail($data['room_type_id']);

        if ($data['guests'] > $roomType->capacity) {
            return back()->withErrors([
                'guests' => "Kapasitas tipe {$roomType->name} maksimal {$roomType->capacity} tamu.",
            ]);
        }

        $checkIn = $data['check_in'];
        $checkOut = $data['check_out'];
        $guests = (int) $data['guests'];
        $nights = $this->nights($checkIn, $checkOut);
        $total = $nights * (float) $roomType->price_per_night;
        $availableCount = RoomAvailability::rooms($roomType->id, $checkIn, $checkOut)->count();

        return view('bookings.create', compact(
            'roomType', 'checkIn', 'checkOut', 'guests', 'nights', 'total', 'availableCount'
        ));
    }

    public function store(Request $request) {
        $data = $request->validate($this->rules() + [
            'notes'=>['nullable', 'string', 'max:500'],
        ]);

        $booking = DB::transaction(function() use($data) {
            $roomType = RoomType::whereKey($data['room_type_id'])->lockForUpdate()->firstOrFail();

            if ($data['guests'] > $roomType->capacity) {
                throw ValidationException::withMessages([
                    'guests' => "Kapasitas tipe {$roomType->name} maksimal {$roomType->capacity} tamu.",
                ]);
            }

            $room = RoomAvailability::rooms($roomType->id, $data['check_in'], $data['check_out'])->first();

            if (! $room) {
                throw ValidationException::withMessages([
                    'check_in' => 'Maaf, tidak ada kamar kosong untuk tipe ini pada tanggal tersebut.',
                ]);
            }

            $nights = $this->nights($data['check_in'], $data['check_out']);

            return Booking::create([
                'booking_code' => $this->generateCode(),
                'user_id' => auth()->id(),
                'room_id' => $room->id,
                'check_in' => $data['check_in'],
                'check_out' => $data['check_out'],
                'guests' => $data['guests'],
                'total_price' => $nights * (float) $roomType->price_per_night,
                'status' => 'pending',
                'payment_status' => 'unpaid',
                'notes' => $data['notes'] ?? null,
            ]);
        });

        return redirect()
            ->route('bookings.show', $booking)
            ->with('success', 'Booking berhasil dibuat. Menunngu konfirmasi admin.');
    }

    public function show(Booking $booking) {
        $this->ensureOwner($booking);
        $booking->load('room.roomType');
        return view('booking.show', compact('booking'));
    }

    public function cancel(Booking $booking) {
        $this->ensureOwner($booking);
        if ($booking->status !== 'pending') {
            return back()->with('error', 'Hanya booking berstatus pending yang bisa dibatalkan.');
        }

        $booking->status = 'cancelled';
        $booking->save();

        return redirect()
            ->route('bookings.index')
            ->with('success', 'Booking berhasil dibatalkan.');
    }

    private function rules(): array {
        return [
            'room_type_id' => ['required', 'exists:room_types,id'],
            'check_in' => ['required', 'date', 'after_or_equal:today'],
            'check_out' => ['required', 'date', 'after:check_in'],
            'guests' => ['required', 'integer', 'min:1'],
        ];
    }

    private function nights(string $checkIn, string $checkOut): int {
        return (int) Carbon::parse($checkIn)->startOfDay()->diffInDays(Carbon::parse($checkOut)->startOfDay());
    }

    private function ensureOwner(Booking $booking): void
    {
        abort_unless($booking->user_id === auth()->id(), 403);
    }

    private function generateCode(): string
    {
        do {
            $code = 'TS-' . now()->format('ymd') . '-' . strtoupper(Str::random(5));
        } while (Booking::where('booking_code', $code)->exists());

        return $code;
    }
}
