<?php

namespace App\Http\Requests\User\comment;

use App\Http\Requests\BaseRequest;

class CommentStoreRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'product_id' => 'required|integer|exists:products,id',
            'comment' => 'required|string|max:255',
        ];
    }
}
