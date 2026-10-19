<?php

namespace App\Http\Requests\Admin;

use App\Enums\PaymentMethodType;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rules\Enum;
use Tymon\JWTAuth\Facades\JWTAuth;

class UpdatePaymentMethodRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $tenantId = JWTAuth::parseToken()->getPayload()->get('tenantId');
        $id = $this->route('payment_method');

        return [
            'name'      => 'required|string|max:100',
            'code'      => "required|string|max:50|unique:payment_methods,code,{$id},id,tenant_id,{$tenantId}",
            'type'      => ['required', new Enum(PaymentMethodType::class)],
            'is_active' => 'boolean',
        ];
    }

    protected function failedValidation(Validator $validator): void
    {
        throw new HttpResponseException(response()->json([
            'message' => 'Error de validación',
            'errors'  => $validator->errors(),
        ], 422));
    }
}
