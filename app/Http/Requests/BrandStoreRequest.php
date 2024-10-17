<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BrandStoreRequest extends FormRequest
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
            "image" => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Brand name is required',
            'image.required' => 'Brand image is required',
            'image.image' => 'Brand image must be an image',
            'image.max' => 'Brand image size must be less than 2MB',
            'image.mimes' => 'Brand image must be jpeg,png,jpg,gif,svg',
        ];
    }
}
