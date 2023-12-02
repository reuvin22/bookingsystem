<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Room;

class RoomImages extends Model
{
    use HasFactory;

    protected $fillable = [
        'room_id',
        'room_images'
    ];

    protected $attributes = [
        'room_id' => 1, // Set your default room_id value here
    ];

    public function room()
    {
        return $this->belongsTo(Room::class, 'id');
    }
}
