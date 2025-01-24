<?php

namespace App\Http\Requests\User\Auth;


use App\Http\Requests\BaseRequest;
use App\Models\User;

class SendVerifyOtpRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'email' => ['required', 'email', 'max:255', 'exists:users,email']
        ];
    }

    // Use this method to inject the User model into the request
    protected function prepareForValidation()
    {
        $this->user = User::where('email', $this->email)->first();
    }
}
