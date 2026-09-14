<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class UpdateFiscalDataRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'tax_id'            => 'sometimes|string|max:50',
            'verification_digit'=> 'sometimes|nullable|string|max:5',
            'tax_regime'        => 'sometimes|nullable|string|max:50',
            'fiscal_address'    => 'sometimes|nullable|string|max:255',
        ];
    }
}
