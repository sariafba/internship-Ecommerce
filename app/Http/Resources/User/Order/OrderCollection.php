<?php

namespace App\Http\Resources\User\Order;

use App\Http\Resources\User\CityResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class OrderCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request): array
    {
        $lang = $request->header('lang') ?: '';

        return $this->collection->map(function ($object) use ($lang) {
            return [
                'id' => $object->id,
                'city' => $object->city->getTranslation('name', $lang),
                'name' => $object->name,
                'phone' => $object->phone,
                'address' => $object->address,
                'is_paid' => $object->is_paid,
                'status' => $object->status,
                'total_price' => $object->total_price,
            ];
        })->toArray();

    }
}
