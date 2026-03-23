<?php
// Author: Emmanuel Cortes

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RemoveFromCartRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'product_id' => $this->route('productId'),
        ]);
    }

    public function rules(): array
    {
        return [
            'product_id' => ['required', 'integer', 'exists:products,id'],
        ];
    }

    public function messages(): array
    {
        return [
            'product_id.required' => 'El producto es requerido.',
            'product_id.integer' => 'El producto debe ser un ID valido.',
            'product_id.exists' => 'El producto seleccionado no existe.',
        ];
    }
}
