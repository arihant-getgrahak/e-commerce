<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateForexRequest extends FormRequest
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
            'name' => 'nullable|string|unique:forexes,name',
            'code' => 'nullable|string|unique:forexes,code',
            'symbol' => 'nullable|string|unique:forexes,symbol',
            'exchange' => 'nullable|string',
            'status' => 'nullable|boolean',
        ];
    }

    public function messages(): array
    {
        return [
            'name.unique' => 'Forex name already exists',
            'code.unique' => 'Forex code already exists',
            'symbol.unique' => 'Forex symbol already exists',
        ];
    }
}
