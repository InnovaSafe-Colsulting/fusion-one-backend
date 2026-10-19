<?php

namespace App\Http\Requests\Products;

use Illuminate\Foundation\Http\FormRequest;
use Tymon\JWTAuth\Facades\JWTAuth;

class StoreProductTypeRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $tenantId = JWTAuth::parseToken()->getPayload()->get('tenantId');

        return [
            'name'        => 'required|string|max:255',
            'slug'        => "required|string|max:100|unique:product_types,slug,NULL,id,tenant_id,{$tenantId}",
            'description' => 'nullable|string',
            'is_active'   => 'nullable|boolean',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required'     => 'El nombre del tipo de producto es obligatorio.',
            'name.max'          => 'El nombre no puede superar los 255 caracteres.',
            'slug.required'     => 'El slug es obligatorio.',
            'slug.max'          => 'El slug no puede superar los 100 caracteres.',
            'slug.unique'       => 'Ya existe un tipo de producto con ese slug.',
            'is_active.boolean' => 'El campo activo debe ser verdadero o falso.',
        ];
    }
}
