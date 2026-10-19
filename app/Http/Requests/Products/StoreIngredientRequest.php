<?php

namespace App\Http\Requests\Products;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class StoreIngredientRequest extends FormRequest
{
    public function authorize(): bool { return true; }

    public function rules(): array
    {
        return [
            'category_id' => ['nullable', 'integer', 'exists:categories,id'],
            'name'        => ['required', 'string', 'max:255'],
            'sku'         => ['nullable', 'string', 'max:100'],
            'unit'        => ['required', 'string', 'max:50'],
            'cost'        => ['required', 'numeric', 'min:0'],
            'is_active'   => ['nullable', 'boolean'],
        ];
    }

    public function messages(): array
    {
        return [
            'category_id.exists' => 'La categoría seleccionada no existe.',
            'name.required'      => 'El nombre es obligatorio.',
            'name.max'           => 'El nombre no puede superar 255 caracteres.',
            'unit.required'      => 'La unidad es obligatoria.',
            'unit.max'           => 'La unidad no puede superar 50 caracteres.',
            'cost.required'      => 'El costo es obligatorio.',
            'cost.numeric'       => 'El costo debe ser numérico.',
            'cost.min'           => 'El costo no puede ser negativo.',
        ];
    }

    protected function failedValidation(Validator $validator): void
    {
        throw new HttpResponseException(
            response()->json(['errors' => $validator->errors()], 422)
        );
    }
}
