<?php

namespace App\Http\Requests\User\Auth;


use App\Http\Requests\BaseRequest;

class UpdateUserProfileRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['nullable', 'string', 'max:255'],
            'phone' => ['nullable', 'regex:/^\+?[1-9]\d{1,14}$/', 'unique:users,phone'],
            'image' => ['nullable','image', 'max:5120'],
            'delete_image' => ['nullable','boolean', 'in:1', 'missing_with:image'],
            'address' => ['nullable', 'string', 'max:255'],
            'city_id' => ['nullable', 'exists:cities,id'],
            'gender' => ['nullable', 'string', 'in:male,female'],
            'birth_date' => ['nullable', 'date_format:Y-m-d']
        ];
    }

}
