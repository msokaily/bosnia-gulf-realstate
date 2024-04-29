<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CategoryResource extends JsonResource
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
            'name' => $this->attributes('name')->data['name'],
            'image_url' => $this->image_url,
            'parent_id' => $this->parent_id,
            'status' => $this->status,
            'children' => CategoryResource::collection($this->children),
            'products' => $this->products,
            'created_at' => $this->created_at->format('Y-m-d h:i A'),
        ];
    }
}
