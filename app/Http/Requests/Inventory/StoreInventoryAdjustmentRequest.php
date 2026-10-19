<?php

namespace App\Http\Requests\Inventory;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class StoreInventoryAdjustmentRequest extends FormRequest
{
    public function authorize(): bool { return true; }

    public function rules(): array
    {
        return [
            'warehouse_id' => 'required|integer|exists:warehouses,id',
            'user_id'      => 'nullable|integer|exists:users,id',
            'reason'       => 'nullable|string|max:255',
            'status'       => 'required|string|max:30',
        ];
    }

    public function messages(): array
    {
        return [
            'warehouse_id.required' => 'La bodega es obligatoria.',
            'warehouse_id.exists'   => 'La bodega no existe.',
            'user_id.exists'        => 'El usuario no existe.',
            'status.required'       => 'El estado es obligatorio.',
            'status.max'            => 'El estado no puede superar 30 caracteres.',
            'reason.max'            => 'La razón no puede superar 255 caracteres.',
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
