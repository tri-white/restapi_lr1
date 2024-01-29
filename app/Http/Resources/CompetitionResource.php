<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\SportsmansResource;
class CompetitionResource extends JsonResource
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
            'name' => $this->name,
            'eventDate' => $this->event_date,
            'eventLocation'=>$this->event_location,
            'prizePool'=>$this->prize_pool,
            'sportsType'=>$this->sports_type,
            'competitors'=>SportsmansResource::collection($this->whenLoaded('sportsmans')),
        ];
    }
}
