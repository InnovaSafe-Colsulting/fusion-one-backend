<?php

namespace App\Http\Requests\Products;

use App\Enums\PriceListEntityType;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rules\Enum;

class StorePriceListItemRequest extends FormRequest
{
    public function authorize(): bool { return true; }

    public function rules(): array
    {
        return [
            'price_list_id' => 'required|integer|exists:price_lists,id',
            'entity_id'     => 'required|integer',
            'entity_type'   => ['required', 'string', new Enum(PriceListEntityType::class)],
            'price'         => 'required|numeric|min:0',
        ];
    }

    public function messages(): array
    {
        return [
            'price_list_id.required' => 'La lista de precios es obligatoria.',
            'price_list_id.exists'   => 'La lista de precios no existe.',
            'entity_id.required'     => 'El ID de la entidad es obligatorio.',
            'entity_type.required'   => 'El tipo de entidad es obligatorio.',
            'entity_type'            => 'El tipo debe ser: product, customer, channel, table, time o event.',
            'price.required'         => 'El precio es obligatorio.',
            'price.min'              => 'El precio no puede ser negativo.',
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
