<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class RegisterRequest extends FormRequest
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
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => [
                'required',
                Password::min(8)->mixedCase()->numbers()->symbols()->uncompromised(),
            ],
            'country_code' => 'required',
            'phone_number' => 'required|numeric|digits:10',
            'confirm_password' => 'required|same:password',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Name is required',
            'email.required' => 'Email is required',
            'email.email' => 'Email is invalid',
            'email.unique' => 'Email already exists',
            'password.required' => 'Password is required',
            'password.min' => 'Password must be at least 6 characters',
            'country_code.required' => 'Country code is required',
            'phone_number.required' => 'Phone number is required',
            'phone_number.string' => 'Phone number is invalid',
            'phone_number.min' => 'Phone number is invalid',
            'phone_number.max' => 'Phone number is invalid',
            'confirm_password.required' => 'Password confirmation is required',
            'confirm_password.same' => 'Password confirmation does not match',
        ];
    }
}
