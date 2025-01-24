<?php

namespace App\Http\Requests\User\Auth;


use App\Http\Requests\BaseRequest;

class VerifyOtpRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'email' => ['required', 'email', 'max:255', 'exists:users,email'],
            'otp' => ['required' , 'string']
        ];
    }
}
