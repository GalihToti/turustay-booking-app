<?php

namespace App\Services;

use App\Models\Room;
use Illuminate\Database\Eloquent\Builder;

class RoomAvailability {
    public static function rooms(int $roomTypeId, string $checkIn, string $checkOut): Builder {
        return Room::query()
            ->where('room_type_id', $roomTypeId)
            ->where('status', 'available')
            ->whereDoesntHave('bookings', function ($query) use ($checkIn, $checkOut) {
                $query->where('status', '!=', 'cancelled')
                    ->where('check_in', '<', $checkOut)
                    ->where('check_out', '>', $checkIn);
            });
    }
}