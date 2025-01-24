<?php

namespace App\Http\Resources\User;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CityResource extends JsonResource
{
    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request): array
    {
        $lang = $request->header('lang') ?: '';

        return [
            'id' => $this->id,
            'name' => $this->getTranslation('name', $lang),
        ];
    }
}
