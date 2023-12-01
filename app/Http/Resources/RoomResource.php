<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\RoomImageResource;
use App\Http\Resources\RoomDetailsResource;
use App\Http\Resources\RoomReviewsResource;

class RoomResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'descriptions' => $this->descriptions,
            'roomDetails' => new RoomDetailsResource($this->roomDetails),
            'roomImages' => new RoomImageResource($this->roomImages),
            'roomReviews' => new RoomReviewsResource($this->roomReviews)
        ];
    }
}
