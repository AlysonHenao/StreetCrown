<?php
// Author: Emmanuel Cortes

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddToCartRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'product_id' => ['required', 'integer', 'exists:products,id'],
            'quantity' => ['nullable', 'integer', 'min:1'],
        ];
    }

    public function messages(): array
    {
        return [
            'product_id.required' => 'El producto es requerido.',
            'product_id.integer' => 'El producto debe ser un ID valido.',
            'product_id.exists' => 'El producto seleccionado no existe.',
            'quantity.integer' => 'La cantidad debe ser un numero entero.',
            'quantity.min' => 'La cantidad debe ser mayor o igual a 1.',
        ];
    }
}
