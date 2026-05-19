<?php

// Author: Emmanuel Cortes

namespace App\Http\Requests\Order;

use Illuminate\Foundation\Http\FormRequest;

class StoreOrderRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'payment_method' => 'required|in:cash,card,transfer',
        ];
    }

    public function messages(): array
    {
        return [
            'payment_method.required' => __('validation.required', ['attribute' => __('checkout.payment_method')]),
            'payment_method.in' => __('order.payment_method_invalid'),
        ];
    }
}