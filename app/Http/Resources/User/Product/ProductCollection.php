<?php

namespace App\Http\Resources\User\Product;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class ProductCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request): array
    {
        $lang = $request->header('lang') ?: '';

        return $this->collection->map(function($object) use($lang){
            return [
                'id' => $object->id,
                'name' => $object->getTranslation('name', $lang),
                'rating' => $object->relationLoaded('reviews') ? (float) $object->reviews()->avg('rate') : null,
                'discount' => $object->relationLoaded('activeDiscounts') ? new DiscountResource($object->activeDiscounts->first()) : null,
                'price' => $object->relationLoaded('productVariants') ? $object->productVariants->first()->price : null,
                'images' => $object->relationLoaded('images') ? $object->images?->pluck('url') : null,
            ];
        })->toArray();
    }
}
