<?php

namespace App\Http\Resources\User\Category;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class CategoryCollection extends ResourceCollection
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
                    'image' => $object->image?->url,
                ];
        })->toArray();
    }
}
