<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;

class Booking extends Model
{
    protected $fillable = [
        'booking_code',
        'user_id',
        'room_id',
        'check_in',
        'check_out',
        'guests',
        'total_price',
        'status',
        'payment_status',
        'notes',
    ];

    protected function casts(): array {
        return [
            'check_in'=>'date',
            'check_out'=>'date',
            'total_price'=>'decimal:2',
        ];
    }

    public function user(): BelongsTo {
        return $this->belongsTo(User::class);
    }

    public function room(): BelongsTo {
        return $this->belongsTo(Room::class);
    }

    public function scopeOverLapping(Builder $query, string $checkIn, string $checkOut): Builder {
        return $query
            ->where('status', '!=', 'cancelled')
            ->where('check_in', '<', $checkOut)
            ->where('check_out', '>', $checkIn);
    }

    public static function generateCode(): string {
        do {
            $code = 'TS-'. now()->format('ymd'). '-'. strtoupper(Str::random(5));
        } while(static::where('booking_code', $code)->exists());

        return $code;
    }
}
