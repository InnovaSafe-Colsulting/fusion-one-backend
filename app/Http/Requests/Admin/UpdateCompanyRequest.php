<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Tymon\JWTAuth\Facades\JWTAuth;

class UpdateCompanyRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $tenantId = JWTAuth::parseToken()->getPayload()->get('tenantId');

        return [
            'name'            => 'sometimes|string|max:255',
            'commercial_name' => 'sometimes|string|max:255',
            'legal_name'      => 'sometimes|string|max:255',
            'email'           => "sometimes|email|max:100|unique:tenants,email,{$tenantId}",
            'phone'           => 'sometimes|string|max:10',
            'address'         => 'sometimes|string|max:100',
            'neighboarhood'   => 'sometimes|string|max:155',
            'timezone'        => 'sometimes|string|max:100',
            'city_id'         => 'sometimes|integer|exists:cities,id',
        ];
    }
}
