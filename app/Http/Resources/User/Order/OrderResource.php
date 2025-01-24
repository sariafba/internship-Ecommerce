<?php

namespace App\Http\Resources\User\Order;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $lang = $request->header('lang') ?: '';

        return [
            'id' => $this->id,
            'city' => $this->city->getTranslation('name', $lang),
            'name' => $this->name,
            'phone' => $this->phone,
            'address' => $this->address,
            'is_paid' => $this->is_paid,
            'status' => $this->status,
            'created_at' => $this->created_at->toDateString(),
            'items' =>
                $this->when($this->relationLoaded('items'),
                    new ItemCollection($this->items)
                ),
            'total_price' => $this->total_price,
        ];
    }
}
