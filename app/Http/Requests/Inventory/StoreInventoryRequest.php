<?php

namespace App\Http\Requests\Inventory;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class StoreInventoryRequest extends FormRequest
{
    public function authorize(): bool { return true; }

    public function rules(): array
    {
        return [
            'warehouse_id'       => 'required|integer|exists:warehouses,id',
            'product_id'         => 'required|integer|exists:products,id',
            'quantity'           => 'required|numeric|min:0',
            'reserved_quantity'  => 'nullable|numeric|min:0',
            'average_cost'       => 'nullable|numeric|min:0',
            'min_stock'          => 'nullable|numeric|min:0',
        ];
    }

    public function messages(): array
    {
        return [
            'warehouse_id.required' => 'La bodega es obligatoria.',
            'warehouse_id.exists'   => 'La bodega no existe.',
            'product_id.required'   => 'El producto es obligatorio.',
            'product_id.exists'     => 'El producto no existe.',
            'quantity.required'     => 'La cantidad es obligatoria.',
            'quantity.min'          => 'La cantidad no puede ser negativa.',
            'reserved_quantity.min' => 'La cantidad reservada no puede ser negativa.',
            'average_cost.min'      => 'El costo promedio no puede ser negativo.',
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
