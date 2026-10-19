<?php

namespace App\Http\Requests\Products;

use App\Enums\PriceListType;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rules\Enum;

class StorePriceListRequest extends FormRequest
{
    public function authorize(): bool { return true; }

    public function rules(): array
    {
        return [
            'name'        => 'required|string|max:100',
            'type'        => ['required', new Enum(PriceListType::class)],
            'description' => 'nullable|string',
            'is_default'  => 'boolean',
            'is_active'   => 'boolean',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'El nombre de la lista de precios es obligatorio.',
            'name.max'      => 'El nombre no puede superar 100 caracteres.',
            'type.required' => 'El tipo de lista es obligatorio.',
            'type.required' => 'El tipo de lista es obligatorio.',
            'type'          => 'El tipo debe ser: product, customer, channel, table, time o event.',
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
