<?php

namespace App\Http\Requests\User\Auth;


use App\Http\Requests\BaseRequest;

class RegisterUserRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email'],
            'phone' => ['required', 'regex:/^\+?[1-9]\d{1,14}$/', 'unique:users,phone'],
            'password' => ['required', 'string', 'min:8', 'max:255'],
            'address' => ['required', 'string', 'max:255'],
            'city_id' => ['required', 'exists:cities,id'],
            'gender' => ['required', 'string', 'in:male,female'],
            'birth_date' => ['required', 'date_format:Y-m-d']
        ];
    }

}
