<?php

namespace App\Http\Requests\Inventory;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class StoreInventoryAdjustmentItemRequest extends FormRequest
{
    public function authorize(): bool { return true; }

    public function rules(): array
    {
        return [
            'adjustment_id'     => 'required|integer|exists:inventory_adjustments,id',
            'product_id'        => 'required|integer|exists:products,id',
            'previous_quantity' => 'required|numeric|min:0',
            'new_quantity'      => 'required|numeric|min:0',
            'difference'        => 'required|numeric',
        ];
    }

    public function messages(): array
    {
        return [
            'adjustment_id.required'     => 'El ajuste es obligatorio.',
            'adjustment_id.exists'       => 'El ajuste no existe.',
            'product_id.required'        => 'El producto es obligatorio.',
            'product_id.exists'          => 'El producto no existe.',
            'previous_quantity.required' => 'La cantidad anterior es obligatoria.',
            'previous_quantity.min'      => 'La cantidad anterior no puede ser negativa.',
            'new_quantity.required'      => 'La nueva cantidad es obligatoria.',
            'new_quantity.min'           => 'La nueva cantidad no puede ser negativa.',
            'difference.required'        => 'La diferencia es obligatoria.',
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
