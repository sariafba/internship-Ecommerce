<?php

namespace App\Http\Requests\User\Review;

use App\Http\Requests\BaseRequest;

class ReviewStoreRequest extends BaseRequest
{
    public function rules(): array
    {
        return [
            'product_id' => 'required|integer|exists:products,id',
            'rate' => 'required|integer|between:1,5',
        ];
    }

}
