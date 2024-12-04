<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateForexRequest extends FormRequest
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
            'name' => 'required|string|unique:forexes,name',
            'code' => 'required|string|unique:forexes,code',
            'symbol' => 'required|string|unique:forexes,symbol',
            'exchange' => 'required|string',
            'status' => 'required|boolean',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'The name field is required.',
            'name.unique' => 'The name has already been taken.',
            'code.required' => 'The code field is required.',
            'code.unique' => 'The code has already been taken.',
            'symbol.required' => 'The symbol field is required.',
            'symbol.unique' => 'The symbol has already been taken.',
            'exchange.required' => 'The exchange field is required.',
            'status.required' => 'The status field is required.',
        ];
    }
}
