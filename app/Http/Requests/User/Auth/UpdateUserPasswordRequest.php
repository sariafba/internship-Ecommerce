<?php

namespace App\Http\Requests\User\Auth;


use App\Http\Requests\BaseRequest;

class UpdateUserPasswordRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'old_password' => ['required', 'string', 'max:255'],
            'new_password' => ['required', 'string', 'min:8', 'max:255', 'confirmed'],
        ];
    }
}
