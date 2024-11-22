<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PickupAddressUpdateRequest extends FormRequest
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
            'name' => 'nullable|string|unique:pickup_addresses,name',
            'email' => 'nullable|email',
            'address' => 'nullable|string',
            'city' => 'nullable|string',
            'state' => 'nullable|string',
            'country' => 'nullable|string',
            'pincode' => 'nullable|numeric|digits:6',
            'phone' => 'nullable|numeric|digits:10',
            'tag' => 'required|string',
            'is_default' => 'nullable|boolean',
        ];
    }
}
