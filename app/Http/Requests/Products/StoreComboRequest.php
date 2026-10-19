<?php

namespace App\Http\Requests\Products;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class StoreComboRequest extends FormRequest
{
    public function authorize(): bool { return true; }

    public function rules(): array
    {
        return [
            'name'                => 'required|string|max:150',
            'description'         => 'nullable|string',
            'price'               => 'required|numeric|min:0',
            'is_active'           => 'boolean',
            'items'               => 'nullable|array',
            'items.*.product_id'  => 'required|integer|exists:products,id',
            'items.*.quantity'    => 'required|numeric|min:0.0001',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required'              => 'El nombre del combo es obligatorio.',
            'name.max'                   => 'El nombre no puede superar 150 caracteres.',
            'price.required'             => 'El precio es obligatorio.',
            'price.numeric'              => 'El precio debe ser un número.',
            'price.min'                  => 'El precio no puede ser negativo.',
            'items.*.product_id.required' => 'Cada ítem debe tener un producto.',
            'items.*.product_id.exists'  => 'Uno o más productos no existen.',
            'items.*.quantity.required'  => 'La cantidad de cada ítem es obligatoria.',
            'items.*.quantity.min'       => 'La cantidad debe ser mayor a 0.',
        ];
    }

    protected function failedValidation(Validator $validator): void
    {
        throw new HttpResponseException(response()->json([
            'message' => 'Error de validación.',
            'errors'  => $validator->errors(),
        ], 422));
    }
}
