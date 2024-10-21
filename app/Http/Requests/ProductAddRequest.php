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
            "name" => "required",
            "description" => "required",
            "price" => "required|decimal:2",
            "stock" => "required|integer|min:0",
            "category_id" => "required|exists:categories,id",
            "added_by" => "required",
            "brand_id" => "required|exists:brands,id",
        ];
    }

    public function messages(): array
    {
        return [
            "name.required" => "Product name is required",
            "description.required" => "Product description is required",
            "price.required" => "Product price is required",
            "stock.required" => "Product stock is required",
            "parent_category_id.required" => "Product parent category is required",
            "child_category_id.required" => "Product child category is required",
            "added_by.required" => "Product added by is required",
            "brand_id.required" => "Brand is required",
            "brand_id.exists" => "Brand does not exist",
        ];
    }
}
