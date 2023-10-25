<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserData extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'firstName',
        'lastName',
        'birthDate',
        'address'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'id');
    }
}
