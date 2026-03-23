<?php
// Author: Emmanuel Cortes

namespace App\Http\Requests;

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
            'payment_method' => ['required', 'string', 'in:cash,card,transfer'],
        ];
    }

    public function messages(): array
    {
        return [
            'payment_method.required' => 'El metodo de pago es requerido.',
            'payment_method.in' => 'El metodo de pago seleccionado no es valido.',
        ];
    }
}
