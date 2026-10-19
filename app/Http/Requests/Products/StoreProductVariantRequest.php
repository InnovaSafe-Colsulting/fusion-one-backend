<?php

namespace App\Http\Requests\Products;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class StoreProductVariantRequest extends FormRequest
{
    public function authorize(): bool { return true; }

    public function rules(): array
    {
        return [
            'product_id' => ['required', 'integer', 'exists:products,id'],
            'name'       => ['required', 'string', 'max:255'],
            'sku'        => ['nullable', 'string', 'max:100'],
            'barcode'    => ['nullable', 'string', 'max:100'],
            'price'      => ['required', 'numeric', 'min:0'],
            'cost'       => ['required', 'numeric', 'min:0'],
            'is_active'  => ['nullable', 'boolean'],
        ];
    }

    public function messages(): array
    {
        return [
            'product_id.required' => 'El producto es obligatorio.',
            'product_id.exists'   => 'El producto seleccionado no existe.',
            'name.required'       => 'El nombre es obligatorio.',
            'name.max'            => 'El nombre no puede superar 255 caracteres.',
            'price.required'      => 'El precio es obligatorio.',
            'price.numeric'       => 'El precio debe ser numérico.',
            'price.min'           => 'El precio no puede ser negativo.',
            'cost.required'       => 'El costo es obligatorio.',
            'cost.numeric'        => 'El costo debe ser numérico.',
            'cost.min'            => 'El costo no puede ser negativo.',
        ];
    }

    protected function failedValidation(Validator $validator): void
    {
        throw new HttpResponseException(
            response()->json(['errors' => $validator->errors()], 422)
        );
    }
}
