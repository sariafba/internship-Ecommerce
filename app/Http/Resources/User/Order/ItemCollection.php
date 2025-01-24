<?php

namespace App\Http\Resources\User\Order;

use App\Http\Resources\User\Product\DiscountResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class ItemCollection extends ResourceCollection
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
            $discount = $object->productVariant->product->discountInTime($object->created_at);
            return [
                'product_id' => $object->productVariant->product->id,
                'product_name' => $object->productVariant->product->getTranslation('name', $lang),
                'product_discount' => new DiscountResource($discount),
                'product_image' => $object->productVariant->product?->images->pluck('url'),
                'amount' => $object->amount,
                'product_variant' => [
                    'id' => $object->productVariant->id,
                    'price' =>
                        $discount ? $object->productVariant->getPriceInItem($discount, $object) : $object->total_price / $object->amount,
                    'attributes_values' => $object->productVariant->attributes_values
                ],
                'total_price' => $object->total_price,
            ];
        })->toArray();
    }
}
