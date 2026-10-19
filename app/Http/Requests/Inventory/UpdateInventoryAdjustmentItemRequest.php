<?php

namespace App\Http\Requests\Inventory;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class UpdateInventoryAdjustmentItemRequest extends FormRequest
{
    public function authorize(): bool { return true; }

    public function rules(): array
    {
        return [
            'adjustment_id'     => 'sometimes|required|integer|exists:inventory_adjustments,id',
            'product_id'        => 'sometimes|required|integer|exists:products,id',
            'previous_quantity' => 'sometimes|required|numeric|min:0',
            'new_quantity'      => 'sometimes|required|numeric|min:0',
            'difference'        => 'sometimes|required|numeric',
        ];
    }

    public function messages(): array
    {
        return [
            'adjustment_id.exists'  => 'El ajuste no existe.',
            'product_id.exists'     => 'El producto no existe.',
            'previous_quantity.min' => 'La cantidad anterior no puede ser negativa.',
            'new_quantity.min'      => 'La nueva cantidad no puede ser negativa.',
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
