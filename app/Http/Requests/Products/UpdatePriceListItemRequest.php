<?php

namespace App\Http\Requests\Products;

use App\Enums\PriceListEntityType;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rules\Enum;

class UpdatePriceListItemRequest extends FormRequest
{
    public function authorize(): bool { return true; }

    public function rules(): array
    {
        return [
            'price_list_id' => 'sometimes|required|integer|exists:price_lists,id',
            'entity_id'     => 'sometimes|required|integer',
            'entity_type'   => ['sometimes', 'required', 'string', new Enum(PriceListEntityType::class)],
            'price'         => 'sometimes|required|numeric|min:0',
        ];
    }

    public function messages(): array
    {
        return [
            'price_list_id.exists' => 'La lista de precios no existe.',
            'entity_type'          => 'El tipo debe ser: product, customer, channel, table, time o event.',
            'price.min'            => 'El precio no puede ser negativo.',
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
