<?php

namespace App\Http\Requests\Inventory;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class UpdateInventoryMovementRequest extends FormRequest
{
    public function authorize(): bool { return true; }

    public function rules(): array
    {
        return [
            'warehouse_id'   => 'sometimes|required|integer|exists:warehouses,id',
            'product_id'     => 'sometimes|required|integer|exists:products,id',
            'user_id'        => 'sometimes|required|integer|exists:users,id',
            'type'           => 'sometimes|required|string|in:in,out,adjustment,transfer',
            'quantity'       => 'sometimes|required|numeric|min:0',
            'unit_cost'      => 'nullable|numeric|min:0',
            'reference_type' => 'nullable|string|max:100',
            'reference_id'   => 'nullable|integer',
            'notes'          => 'nullable|string',
        ];
    }

    public function messages(): array
    {
        return [
            'warehouse_id.exists' => 'La bodega no existe.',
            'product_id.exists'   => 'El producto no existe.',
            'user_id.exists'      => 'El usuario no existe.',
            'type.in'             => 'El tipo debe ser: in, out, adjustment o transfer.',
            'quantity.min'        => 'La cantidad no puede ser negativa.',
            'unit_cost.min'       => 'El costo unitario no puede ser negativo.',
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
