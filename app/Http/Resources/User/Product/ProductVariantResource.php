<?php

namespace App\Http\Resources\User\Product;

use App\Models\Attribute;
use App\Models\AttributeValue;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductVariantResource extends JsonResource
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
            'remaining_amount' => $this->when($this->remaining_amount,$this->remaining_amount),
            'price' => $this->price,
            'attributes_values' => $this->attributes_values,
        ];
    }
}
