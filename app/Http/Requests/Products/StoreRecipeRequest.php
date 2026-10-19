<?php

namespace App\Http\Requests\Products;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class StoreRecipeRequest extends FormRequest
{
    public function authorize(): bool { return true; }

    public function rules(): array
    {
        return [
            'name'                        => ['required', 'string', 'max:255'],
            'description'                 => ['nullable', 'string'],
            'is_active'                   => ['nullable', 'boolean'],
            'ingredients'                 => ['nullable', 'array'],
            'ingredients.*.ingredient_id' => ['required_with:ingredients', 'integer', 'exists:ingredients,id'],
            'ingredients.*.quantity'      => ['required_with:ingredients', 'numeric', 'min:0'],
            'ingredients.*.unit'          => ['required_with:ingredients', 'string', 'max:50'],
            'ingredients.*.total'         => ['required_with:ingredients', 'numeric', 'min:0'],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required'                        => 'El nombre es obligatorio.',
            'name.max'                             => 'El nombre no puede superar 255 caracteres.',
            'ingredients.*.ingredient_id.required_with' => 'El ingrediente es obligatorio.',
            'ingredients.*.ingredient_id.exists'   => 'El ingrediente seleccionado no existe.',
            'ingredients.*.quantity.required_with' => 'La cantidad es obligatoria.',
            'ingredients.*.quantity.numeric'       => 'La cantidad debe ser numérica.',
            'ingredients.*.unit.required_with'     => 'La unidad es obligatoria.',
            'ingredients.*.total.required_with'    => 'El total es obligatorio.',
            'ingredients.*.total.numeric'          => 'El total debe ser numérico.',
        ];
    }

    protected function failedValidation(Validator $validator): void
    {
        throw new HttpResponseException(
            response()->json(['errors' => $validator->errors()], 422)
        );
    }
}
