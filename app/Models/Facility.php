<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Facility extends Model
{
    protected $fillable = [
        'name',
        'icon',
    ];

    public function room_types(): BelongsToMany {
        return $this->belongsToMany(RoomType::class, 'facility_room_type');
    }
}
