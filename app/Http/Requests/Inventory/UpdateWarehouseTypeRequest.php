<?php

namespace App\Http\Requests\Inventory;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class UpdateWarehouseTypeRequest extends FormRequest
{
    public function authorize(): bool { return true; }

    public function rules(): array
    {
        return [
            'name'        => 'sometimes|required|string|max:100',
            'slug'        => 'sometimes|required|string|max:100',
            'description' => 'nullable|string',
            'is_system'   => 'boolean',
            'is_active'   => 'boolean',
        ];
    }

    public function messages(): array
    {
        return [
            'name.max' => 'El nombre no puede superar 100 caracteres.',
            'slug.max' => 'El slug no puede superar 100 caracteres.',
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
