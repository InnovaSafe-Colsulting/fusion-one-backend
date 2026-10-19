<?php

namespace App\Http\Requests\Products;

use Illuminate\Foundation\Http\FormRequest;
use Tymon\JWTAuth\Facades\JWTAuth;

class StoreCategoryRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $tenantId = JWTAuth::parseToken()->getPayload()->get('tenantId');

        return [
            'parent_id'   => 'nullable|integer|exists:categories,id',
            'name'        => 'required|string|max:100',
            'slug'        => "required|string|max:100|unique:categories,slug,NULL,id,tenant_id,{$tenantId}",
            'description' => 'nullable|string',
            'is_active'   => 'nullable|boolean',
        ];
    }

    public function messages(): array
    {
        return [
            'parent_id.integer' => 'La categoría padre debe ser un identificador válido.',
            'parent_id.exists'  => 'La categoría padre seleccionada no existe.',
            'name.required'     => 'El nombre de la categoría es obligatorio.',
            'name.max'          => 'El nombre no puede superar los 100 caracteres.',
            'slug.required'     => 'El slug es obligatorio.',
            'slug.max'          => 'El slug no puede superar los 100 caracteres.',
            'slug.unique'       => 'Ya existe una categoría con ese slug.',
            'is_active.boolean' => 'El campo activo debe ser verdadero o falso.',
        ];
    }
}
