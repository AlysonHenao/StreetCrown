<?php

// Author: Samuel Moncada Mejía

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProfileRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'min:2', 'max:255'],
            'phone' => ['required', 'string', 'max:20'],
            'address' => ['required', 'string', 'max:255'],
            'city' => ['required', 'string', 'max:100'],
            'postal_code' => ['required', 'string', 'max:20'],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => __('validation.name_required'),
            'name.min' => __('validation.name_min'),
            'phone.required' => __('validation.phone_required'),
            'address.required' => __('validation.address_required'),
            'city.required' => __('validation.city_required'),
            'postal_code.required' => __('validation.postal_code_required'),
        ];
    }
}