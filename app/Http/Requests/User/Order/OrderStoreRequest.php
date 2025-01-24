<?php

namespace App\Http\Requests\User\Order;

use App\Http\Requests\BaseRequest;

class OrderStoreRequest extends BaseRequest
{
    public function rules(): array
    {
        return [
            'city_id' => 'nullable|exists:cities,id',

            'name' => 'nullable|string',
            'phone' => 'nullable|string|regex:/^\+?[1-9]\d{1,14}$/',
            'address' => 'nullable|string|min:10|max:255',

            'items' => 'required|array',
            'items.*.product_variant_id' => 'required|exists:product_variants,id',
            'items.*.amount' => 'required|integer|min:1',
        ];
    }

}
