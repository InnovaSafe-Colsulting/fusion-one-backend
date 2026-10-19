<?php

namespace App\Http\Requests\Inventory;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class StoreInventoryLotRequest extends FormRequest
{
    public function authorize(): bool { return true; }

    public function rules(): array
    {
        return [
            'warehouse_id'    => 'required|integer|exists:warehouses,id',
            'product_id'      => 'required|integer|exists:products,id',
            'lot_number'      => 'required|string|max:100',
            'quantity'        => 'required|numeric|min:0',
            'expiration_date' => 'nullable|date',
            'unit_cost'       => 'nullable|numeric|min:0',
        ];
    }

    public function messages(): array
    {
        return [
            'warehouse_id.required'  => 'La bodega es obligatoria.',
            'warehouse_id.exists'    => 'La bodega no existe.',
            'product_id.required'    => 'El producto es obligatorio.',
            'product_id.exists'      => 'El producto no existe.',
            'lot_number.required'    => 'El número de lote es obligatorio.',
            'lot_number.max'         => 'El número de lote no puede superar 100 caracteres.',
            'quantity.required'      => 'La cantidad es obligatoria.',
            'quantity.min'           => 'La cantidad no puede ser negativa.',
            'expiration_date.date'   => 'La fecha de vencimiento no es válida.',
            'unit_cost.min'          => 'El costo unitario no puede ser negativo.',
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
