<?php

namespace App\Http\Requests\User\comment;

use App\Http\Requests\BaseRequest;

class CommentUpdateRequest extends BaseRequest
{
    public function rules(): array
    {
        return [
            'comment' => 'required|string|max:255',
        ];
    }

}
