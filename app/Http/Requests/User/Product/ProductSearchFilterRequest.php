<?php

namespace App\Http\Requests\User\Product;

use App\Http\Requests\BaseRequest;

class ProductSearchFilterRequest extends BaseRequest
{
    public function rules(): array
    {
        return [
          'q' => 'nullable|string',
        ];
    }

}
