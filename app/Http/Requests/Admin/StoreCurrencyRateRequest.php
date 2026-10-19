<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class StoreCurrencyRateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'currency_id'          => 'required|integer|exists:currencies,id',
            'rate'                 => 'required|numeric|min:0',
            'value_from_currency'  => 'required|string|size:3',
            'value_to_currency'    => 'required|string|size:3',
            'is_active'            => 'nullable|boolean',
        ];
    }

    public function messages(): array
    {
        return [
            'currency_id.required'         => 'La moneda es obligatoria.',
            'currency_id.exists'           => 'La moneda seleccionada no existe.',
            'rate.required'                => 'La tasa de cambio es obligatoria.',
            'rate.numeric'                 => 'La tasa debe ser un valor numérico.',
            'rate.min'                     => 'La tasa no puede ser negativa.',
            'value_from_currency.required' => 'La moneda de origen es obligatoria.',
            'value_from_currency.size'     => 'La moneda de origen debe tener 3 caracteres (ej. USD).',
            'value_to_currency.required'   => 'La moneda de destino es obligatoria.',
            'value_to_currency.size'       => 'La moneda de destino debe tener 3 caracteres (ej. COP).',
            'is_active.boolean'            => 'El campo activo debe ser verdadero o falso.',
        ];
    }
}
