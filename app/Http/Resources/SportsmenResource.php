<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SportsmenResource extends JsonResource
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
            'address'=>$this->address,
            'state'=>$this->state,
            'type'=>$this->type,
            'postalCode'=>$this->postal_code,
            'city'=>$this->city,
            'invoices'=>InvoiceResource::collection($this->whenLoaded('invoices')),
        ];
    }
}
