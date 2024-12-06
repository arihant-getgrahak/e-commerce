<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateLanguageRequest extends FormRequest
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
            'rtl' => 'nullable|boolean',
            'status' => 'nullable|boolean',
            'default' => 'nullable|boolean',
        ];
    }
}