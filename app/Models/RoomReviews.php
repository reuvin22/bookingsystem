<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Room;

class RoomReviews extends Model
{
    use HasFactory;

    protected $fillable = [
        'room_id',
        'ratings',
        'comments'
    ];

    public function room()
    {
        return $this->belongsTo(Room::class, 'id');
    }
}
