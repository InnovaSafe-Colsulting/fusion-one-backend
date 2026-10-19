<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCurrencyRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $id = $this->route('currency');

        return [
            'code'           => "sometimes|string|size:3|unique:currencies,code,{$id}",
            'name'           => 'sometimes|string|max:100',
            'symbol'         => 'nullable|string|max:10',
            'decimal_places' => 'nullable|integer|min:0|max:4',
            'is_active'      => 'nullable|boolean',
        ];
    }

    public function messages(): array
    {
        return [
            'code.size'            => 'El código debe tener exactamente 3 caracteres (ej. USD, COP).',
            'code.unique'          => 'Ya existe una moneda con ese código.',
            'name.max'             => 'El nombre no puede superar los 100 caracteres.',
            'symbol.max'           => 'El símbolo no puede superar los 10 caracteres.',
            'decimal_places.integer' => 'Los decimales deben ser un número entero.',
            'decimal_places.min'   => 'Los decimales no pueden ser negativos.',
            'decimal_places.max'   => 'Los decimales no pueden ser mayor a 4.',
            'is_active.boolean'    => 'El campo activo debe ser verdadero o falso.',
        ];
    }
}
