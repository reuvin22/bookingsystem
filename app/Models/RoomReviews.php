<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class RoomReviews extends Model
{
    use HasFactory;

    protected $fillable = [
        'room_id',
        'ratings',
        'comments'
    ];

    public function room():BelongsTo
    {
        return $this->belongsTo(Room::class, 'id');
    }
}
