<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\Room;

class RoomDetails extends Model
{
    use HasFactory;

    protected $fillable = [
        'room_id',
        'room_details'
    ];

    public function room()
    {
        return $this->belongsTo(Room::class, 'id');
    }
}
