<?php

namespace App\Http\Requests\Inventory;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class StoreWarehouseRequest extends FormRequest
{
    public function authorize(): bool { return true; }

    public function rules(): array
    {
        return [
            'branch_id'         => 'required|integer|exists:branches,id',
            'name'              => 'required|string|max:100',
            'code'              => 'required|string|max:20',
            'warehouse_type_id' => 'required|integer|exists:warehouse_types,id',
            'is_active'         => 'boolean',
        ];
    }

    public function messages(): array
    {
        return [
            'branch_id.required'         => 'La sucursal es obligatoria.',
            'branch_id.exists'           => 'La sucursal no existe.',
            'name.required'              => 'El nombre de la bodega es obligatorio.',
            'name.max'                   => 'El nombre no puede superar 100 caracteres.',
            'code.required'              => 'El código de la bodega es obligatorio.',
            'code.max'                   => 'El código no puede superar 20 caracteres.',
            'warehouse_type_id.required' => 'El tipo de bodega es obligatorio.',
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
