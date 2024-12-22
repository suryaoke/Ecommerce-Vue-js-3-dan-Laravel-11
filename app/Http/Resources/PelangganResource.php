<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PelangganResource extends JsonResource
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
            'address' => $this->address,
            'city' => $this->city,
            'zip_code' => $this->zip_code,
            'country' => $this->country,
            'phone_number' => $this->phone_number,
            'profile_image' => $this->image_path,
            'profile_completed' => $this->profile_completed,
            'orders' => $this->orders
        ];
    }
}
