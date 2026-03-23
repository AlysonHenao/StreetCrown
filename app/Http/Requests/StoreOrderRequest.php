<?php
// Author: Emmanuel Cortes, Samuel Moncada Mejía

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreOrderRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user() !== null;
    }

    public function rules(): array
    {
        return [
            'payment_method' => ['required', 'string', 'in:cash,card,transfer'],
        ];
    }

    public function messages(): array
    {
        return [
            'payment_method.required' => __('order.payment_method_required'),
            'payment_method.in' => __('order.payment_method_invalid'),
        ];
    }
}