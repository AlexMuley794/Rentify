<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PropertyResource extends JsonResource
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
            'title' => $this->title,
            'address' => $this->address,
            'type' => $this->type,
            'price' => $this->price,
            'description' => $this->description,
            'image_path' => $this->image_path ? asset('storage/' . $this->image_path) : null,
            'is_occupied' => $this->is_occupied,
            'current_tenant' => $this->current_tenant,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
