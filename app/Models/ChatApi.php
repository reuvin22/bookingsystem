<?php

namespace App\Models;

use App\Models\User;
use MongoDB\Laravel\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ChatApi extends Model
{
    use HasFactory;

    protected $connection = 'mongodb';
    protected $collection = 'chats';
    protected $fillable = [
        'user_id',
        'chat',
        'name',
        'to',
        'receiver_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id');
    }
}
