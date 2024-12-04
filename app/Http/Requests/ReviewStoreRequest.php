<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ReviewStoreRequest extends FormRequest
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
            'product_id' => 'required|exists:products,id',
            'comment' => 'required',
            'rating' => 'required|float|min:1|max:5',
            'name' => 'required',
            'email' => 'required|email',
        ];
    }

    public function messages(): array
    {
        return [
            'product_id.required' => 'Product ID is required',
            'product_id.exists' => 'Product ID does not exist',
            'comment.required' => 'Comment is required',
            'rating.required' => 'Rating is required',
            'rating.float' => 'Rating must be a number',
            'rating.min' => 'Rating must be greater than 1',
            'rating.max' => 'Rating must be less than 5',
            'name.required' => 'Name is required',
            'email.required' => 'Email is required',
            'email.email' => 'Email must be a valid email',
        ];
    }
}
