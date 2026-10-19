<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Tymon\JWTAuth\Facades\JWTAuth;

class StoreBranchRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $tenantId = JWTAuth::parseToken()->getPayload()->get('tenantId');

        return [
            'name'      => 'required|string|max:150',
            'code'      => "required|string|max:50|unique:branches,code,NULL,id,tenant_id,{$tenantId}",
            'address'   => 'nullable|string|max:255',
            'phone'     => 'nullable|string|max:50',
            'email'     => 'nullable|email|max:150',
            'city_id'   => 'required|integer|exists:cities,id',
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
