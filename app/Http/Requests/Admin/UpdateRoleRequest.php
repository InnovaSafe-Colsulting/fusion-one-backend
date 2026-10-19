<?php

namespace App\Http\Requests\Admin;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Tymon\JWTAuth\Facades\JWTAuth;

class UpdateRoleRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $tenantId = JWTAuth::parseToken()->getPayload()->get('tenantId');
        $id = $this->route('role');

        return [
            'name'        => 'required|string|max:100',
            'slug'        => "required|string|max:100|unique:roles,slug,{$id},id,tenant_id,{$tenantId}",
            'description' => 'nullable|string',
            'is_active'   => 'boolean',
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
