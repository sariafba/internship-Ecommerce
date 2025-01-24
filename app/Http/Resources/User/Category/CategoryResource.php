<?php

namespace App\Http\Resources\User\Category;

use App\Models\Category;
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
        $lang = $request->header('lang') ?: '';

        return  [
            'id' => $this->id,
            'name' => $this->getTranslation('name', $lang),
            'image' => $this->image?->url,
            'sub_categories' => new CategoryCollection($this->children)
        ];
    }
}
