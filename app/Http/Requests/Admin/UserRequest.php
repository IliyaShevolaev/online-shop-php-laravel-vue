<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string',
            'surname' => 'required|string',
            'email' => 'required|string|email|unique:users,email',
            'role' => 'required|integer',
            // 'password' => 'required|string',
            'age' => 'nullable|integer',
            'gender' => 'nullable|integer',
            'address' => 'nullable|string',
        ];
    }
}
