<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use App\Http\Resources\RoomResource;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'email' => $this->email,
            'fullName' => $this->fullName,
            'rooms' => new RoomResource($this->rooms),
        ];
    }
}
