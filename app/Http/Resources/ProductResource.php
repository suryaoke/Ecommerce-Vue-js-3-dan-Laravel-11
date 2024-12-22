<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
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
            'slug' => $this->slug,
            'qty' => $this->qty,
            'price' => $this->price,
            'desc' => $this->desc,
            'category' => $this->category,
            'brand' => $this->brand,
            'colors' => $this->colors,
            'sizes' => $this->sizes,
            'reviews' => $this->reviews,
            'status' => $this->status,
            'thumbnail' => $this->thumbnail ? asset('storage/' . $this->thumbnail) : null, // Mengoreksi URL thumbnail
            'first_image' => $this->first_image ? asset('storage/' . $this->first_image) : null,
            'second_image' => $this->second_image ? asset('storage/' . $this->second_image) : null,
            'third_image' => $this->third_image ? asset('storage/' . $this->third_image) : null,
        ];
    }
}
