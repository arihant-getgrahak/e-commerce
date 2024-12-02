<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateStoreRequest extends FormRequest
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
            'name' => 'required|string',
            'address' => 'required|string',
            'city' => 'required|string',
            'state' => 'required|string',
            'country' => 'required|string',
            'pincode' => 'required|string',
            'phone' => 'required|numeric|digits:10',
            'gst' => 'required|string',
            'tax_value' => 'required|string',
            'tax_type' => 'required|string|in:inclusive,exclusive',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Store name is required',
            'address.required' => 'Store address is required',
            'city.required' => 'Store city is required',
            'state.required' => 'Store state is required',
            'country.required' => 'Store country is required',
            'pincode.required' => 'Store pincode is required',
            'phone.required' => 'Store phone is required',
            'gst.required' => 'Store gst is required',
            'tax_value.required' => 'Store tax value is required',
            'tax_type.required' => 'Store tax type is required',
        ];
    }
}
