<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddLanguageRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth()->check() && auth()->user()->role === 'admin';
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|unique:languages,name',
            'code' => 'required|string|unique:languages,code',
            'status' => 'required|boolean',
            'rtl' => 'required|boolean',
            'default' => 'required|boolean',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'The name field is required.',
            'name.string' => 'The name field must be a string.',
            'name.unique' => 'The name field must be unique.',
            'code.required' => 'The code field is required.',
            'code.string' => 'The code field must be a string.',
            'code.unique' => 'The code field must be unique.',
            'status.required' => 'The status field is required.',
            'status.boolean' => 'The status field must be a boolean.',
            'rtl.required' => 'The rtl field is required.',
            'rtl.boolean' => 'The rtl field must be a boolean.',
            'default.required' => 'The default field is required.',
        ];
    }
}
