<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

// use Rule

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
            'name' => [
                'nullable',
                'string',
                Rule::unique('forexes', 'name')->ignore($this->id),
            ],
            'code' => [
                'nullable',
                'string',
                Rule::unique('forexes', 'code')->ignore($this->id),
            ],
            'symbol' => [
                'nullable',
                'string',
                Rule::unique('forexes', 'symbol')->ignore($this->id),
            ],
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
