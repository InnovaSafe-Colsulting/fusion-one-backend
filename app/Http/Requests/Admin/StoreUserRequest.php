<?php

namespace App\Http\Requests\Admin;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rules\Password;

class StoreUserRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'first_name' => 'required|string|max:100',
            'last_name'  => 'required|string|max:100',
            'email'      => 'required|email|max:150|unique:users,email',
            'password'   => ['required', Password::min(8)->max(12)->mixedCase()->numbers()->symbols()],
            'cellphone'  => 'nullable|string|max:50',
            'city_id'    => 'nullable|integer|exists:cities,id',
            'is_active'  => 'boolean',
            'role_id'    => 'required|integer|exists:roles,id',
        ];
    }

    public function messages(): array
    {
        return [
            'password' => 'La contraseña debe tener entre 8 y 12 caracteres, al menos una mayúscula, una minúscula, un número y un símbolo especial.',
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
