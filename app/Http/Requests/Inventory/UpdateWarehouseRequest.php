<?php

namespace App\Http\Requests\Inventory;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class UpdateWarehouseRequest extends FormRequest
{
    public function authorize(): bool { return true; }

    public function rules(): array
    {
        return [
            'branch_id'         => 'sometimes|required|integer|exists:branches,id',
            'name'              => 'sometimes|required|string|max:100',
            'code'              => 'sometimes|required|string|max:20',
            'warehouse_type_id' => 'sometimes|required|integer|exists:warehouse_types,id',
            'is_active'         => 'boolean',
        ];
    }

    public function messages(): array
    {
        return [
            'branch_id.exists'           => 'La sucursal no existe.',
            'name.max'                   => 'El nombre no puede superar 100 caracteres.',
            'code.max'                   => 'El código no puede superar 20 caracteres.',
            'warehouse_type_id.exists'   => 'El tipo de bodega no existe.',
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
