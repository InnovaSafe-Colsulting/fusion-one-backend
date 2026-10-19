<?php

namespace App\Http\Requests\Products;

use Illuminate\Foundation\Http\FormRequest;
use Tymon\JWTAuth\Facades\JWTAuth;

class UpdateCategoryRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $tenantId = JWTAuth::parseToken()->getPayload()->get('tenantId');
        $id = $this->route('category');

        return [
            'parent_id'   => 'nullable|integer|exists:categories,id',
            'name'        => 'sometimes|string|max:100',
            'slug'        => "sometimes|string|max:100|unique:categories,slug,{$id},id,tenant_id,{$tenantId}",
            'description' => 'nullable|string',
            'is_active'   => 'nullable|boolean',
        ];
    }

    public function messages(): array
    {
        return [
            'parent_id.integer' => 'La categoría padre debe ser un identificador válido.',
            'parent_id.exists'  => 'La categoría padre seleccionada no existe.',
            'name.max'          => 'El nombre no puede superar los 100 caracteres.',
            'slug.max'          => 'El slug no puede superar los 100 caracteres.',
            'slug.unique'       => 'Ya existe una categoría con ese slug.',
            'is_active.boolean' => 'El campo activo debe ser verdadero o falso.',
        ];
    }
}
