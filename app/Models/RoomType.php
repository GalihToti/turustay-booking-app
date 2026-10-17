<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class RoomType extends Model
{
    protected $fillable = [
        'name',
        'description',
        'price_per_night',
        'capacity',
        'image',
    ];

    protected function casts(): array
    {
        return [
            'price_per_night' => 'decimal:2',
        ];
    }

    public function rooms(): HasMany {
        return $this->hasMany(Room::class);
    }

    public function facilities(): BelongsToMany {
        return $this->belongsToMany(Facility::class, 'facility_room_type');
    }
}
