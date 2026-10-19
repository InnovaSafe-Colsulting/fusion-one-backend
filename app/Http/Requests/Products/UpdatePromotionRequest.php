<?php

namespace App\Http\Requests\Products;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class UpdatePromotionRequest extends FormRequest
{
    public function authorize(): bool { return true; }

    public function rules(): array
    {
        return [
            'name'        => 'sometimes|required|string|max:150',
            'description' => 'nullable|string',
            'type'        => 'sometimes|required|string|in:percentage,fixed,2x1,free_product',
            'value'       => 'sometimes|required|numeric|min:0',
            'starts_at'   => 'nullable|date',
            'ends_at'     => 'nullable|date|after_or_equal:starts_at',
            'is_active'   => 'boolean',
            'products'    => 'nullable|array',
            'products.*'  => 'integer|exists:products,id',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required'          => 'El nombre de la promoción es obligatorio.',
            'name.max'               => 'El nombre no puede superar 150 caracteres.',
            'type.required'          => 'El tipo de promoción es obligatorio.',
            'type.in'                => 'El tipo debe ser: percentage, fixed, 2x1 o free_product.',
            'value.required'         => 'El valor de la promoción es obligatorio.',
            'value.numeric'          => 'El valor debe ser un número.',
            'value.min'              => 'El valor no puede ser negativo.',
            'starts_at.date'         => 'La fecha de inicio no es válida.',
            'ends_at.date'           => 'La fecha de fin no es válida.',
            'ends_at.after_or_equal' => 'La fecha de fin debe ser igual o posterior a la fecha de inicio.',
            'products.*.integer'     => 'Los productos deben ser IDs válidos.',
            'products.*.exists'      => 'Uno o más productos no existen.',
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
