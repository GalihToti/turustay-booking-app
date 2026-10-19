<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Room extends Model
{
    protected $fillable = [
        'room_type_id',
        'room_number',
        'floor',
        'status',
    ];

    public function roomType(): BelongsTo {
        return $this->belongsTo(RoomType::class);
    }

    public function bookings(): HasMany {
        return $this->hasMany(Booking::class);
    }

    public function scopeAvailable(Builder $query, string $checkIn, string $checkOut): Builder {
        return $query
            ->where('status', 'available')
            ->whereDoesntHave('bookings', function (Builder $q) use ($checkIn, $checkOut) {
                $q->overlapping($checkIn, $checkOut);
            });
    }
}
