<?php

namespace App\Http\Requests\Products;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class UpdateModifierRequest extends FormRequest
{
    public function authorize(): bool { return true; }

    public function rules(): array
    {
        return [
            'name'                   => 'sometimes|required|string|max:100',
            'selection_type'         => 'sometimes|required|string|in:single,multiple',
            'min_selection'          => 'integer|min:0',
            'max_selection'          => 'nullable|integer|min:1',
            'is_active'              => 'boolean',
            'options'                => 'nullable|array|min:1',
            'options.*.name'         => 'required|string|max:100',
            'options.*.price'        => 'numeric|min:0',
            'options.*.is_active'    => 'boolean',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required'              => 'El nombre del modificador es obligatorio.',
            'name.max'                   => 'El nombre no puede superar 100 caracteres.',
            'selection_type.required'    => 'El tipo de selección es obligatorio.',
            'selection_type.in'          => 'El tipo de selección debe ser "single" o "multiple".',
            'min_selection.integer'      => 'La selección mínima debe ser un número entero.',
            'min_selection.min'          => 'La selección mínima no puede ser negativa.',
            'max_selection.integer'      => 'La selección máxima debe ser un número entero.',
            'max_selection.min'          => 'La selección máxima debe ser al menos 1.',
            'options.min'                => 'Debe incluir al menos una opción.',
            'options.*.name.required'    => 'Cada opción debe tener un nombre.',
            'options.*.name.max'         => 'El nombre de la opción no puede superar 100 caracteres.',
            'options.*.price.numeric'    => 'El precio de la opción debe ser un número.',
            'options.*.price.min'        => 'El precio de la opción no puede ser negativo.',
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
