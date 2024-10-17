<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ChildCategoryStoreRequest extends FormRequest
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
            "parent_category_id" => 'required|exists:parent_categories,id',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Name is required',
            'parent_category_id.required' => 'Parent category is required',
            'parent_category_id.exists'=> 'Parent category does not exist',
        ];
    }
}
