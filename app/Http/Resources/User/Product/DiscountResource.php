<?php

namespace App\Http\Resources\User\Product;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DiscountResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request)
    {
        $lang = $request->header('lang') ?: '';

        return [
            'name' => $this->getTranslation('name', $lang),
            'value' => $this->value,
            'type' => $this->type,
        ];
    }
}
