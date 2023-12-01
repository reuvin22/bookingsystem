<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\RoomImages;
use App\Models\RoomDetails;
use App\Models\RoomReviews;

class Room extends Model
{
    use HasFactory;

    protected $fillable = [
        'descriptions'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id');
    }
    public function roomDetails()
    {
        return $this->hasOne(RoomDetails::class, 'room_id');
    }
    public function roomImages()
    {
        return $this->hasOne(RoomImages::class, 'room_id');
    }
    public function roomReviews()
    {
        return $this->hasOne(RoomReviews::class, 'room_id');
    }
}
