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
        parent::toArray($request);

        return [
            'id' => $this->id,
            'title' => $this->title,
            'description' => $this->description,
            'photo' => $this->photo,
            'pdf' => $this->pdf,
            'selling_method' => $this->selling_method,
            'price' => $this->price,
            'category' => new CategoryResource($this->whenLoaded('category')),
            'brand' => new BrandResource($this->whenLoaded('brand')),
            'user' => new UserResource($this->whenLoaded('user')),
            'author' => new AuthorResource($this->whenLoaded('author')),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
