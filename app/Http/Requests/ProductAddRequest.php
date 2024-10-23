<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductAddRequest extends FormRequest
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
            'description' => 'required',
            'price' => "required|numeric|regex:/^\d+(\.\d{1,2})?$/",  // Corrected the price rule
            'stock' => 'required|integer|min:1',
            'category_id' => 'required|exists:categories,id',
            'brand_id' => 'required|exists:brands,id',
            'sku' => 'required',
            'weight' => 'required',
            'slug' => 'required|unique:products,slug',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Product name is required',
            'description.required' => 'Product description is required',
            'price.required' => 'Product price is required',
            'price.numeric' => 'Product price must be a valid number',
            'price.regex' => 'Product price must have up to 2 decimal places',
            'stock.required' => 'Product stock is required',
            'category_id.required' => 'Product category is required',
            'category_id.exists' => 'The selected category does not exist',
            'added_by.required' => 'Product added by is required',
            'brand_id.required' => 'Brand is required',
            'brand_id.exists' => 'Brand does not exist',
        ];
    }
}
