<?php
// Author: Samuel Moncada Mejía

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
            'total' => ['required', 'integer', 'min:0'],
            'payment_method' => ['required', 'string', 'in:credit_card,debit_card,paypal,bank_transfer'],
            'date' => ['required', 'date'],
            'status' => ['required', 'string', 'in:pending,completed,cancelled'],
        ];
    }

    public function messages(): array
    {
        return [
            'total.required' => __('order.total_required'),
            'total.integer' => __('order.total_integer'),
            'total.min' => __('order.total_min'),
            'payment_method.required' => __('order.payment_method_required'),
            'payment_method.in' => __('order.payment_method_invalid'),
            'date.required' => __('order.date_required'),
            'date.date' => __('order.date_invalid'),
            'status.required' => __('order.status_required'),
            'status.in' => __('order.status_invalid'),
        ];
    }
}
