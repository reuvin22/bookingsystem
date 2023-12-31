<?php

namespace App\Http\Requests\AuthData;

use Illuminate\Foundation\Http\FormRequest;

class UserRegistrationRequest extends FormRequest
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
            'fullname' => 'string|required',
            'email' => 'email|required',
            'password' => 'string|required|min:8',
            'password' => 'string|required|confirmed|min:8'
        ];
    }
}
