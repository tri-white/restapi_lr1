<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\RegulationResource;

class SportsmansResource extends JsonResource
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
            'email' => $this->email,
            'gender'=>$this->gender,
            'category'=>$this->category,
            'sponsor'=>$this->sponsor,
            'regulations'=>RegulationResource::collection($this->whenLoaded('regulations')),
        ];
    }
}
