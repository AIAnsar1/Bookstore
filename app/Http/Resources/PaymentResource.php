<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PaymentResource extends JsonResource
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
            'amount' => $this->amount,
            'user' => new UserResource($this->whenLoaded('user')),
            'tarif' => new TarifeResource($this->whenLoaded('tarif')),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
