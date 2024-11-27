<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PickupAddressRequest extends FormRequest
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
            'email' => 'required|email',
            'address' => 'required|string',
            'city' => 'required|string',
            'state' => 'required|string',
            'country' => 'required|string',
            'pincode' => 'required|numeric|digits:6',
            'phone' => 'required|numeric|digits:10',
            'is_default' => 'required|boolean',
            'tag' => 'required|string|unique:pickup_addresses,tag',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Pickup address name is required.',
            'name.unique' => 'Pickup address name already exists.',
            'email.required' => 'Pickup address email is required.',
            'email.email' => 'Pickup address email is invalid.',
            'address.required' => 'Pickup address address is required.',
            'city.required' => 'Pickup address city is required.',
            'state.required' => 'Pickup address state is required.',
            'country.required' => 'Pickup address country is required.',
            'pincode.required' => 'Pickup address pincode is required.',
            'phone.required' => 'Pickup address phone is required.',
            'is_default.required' => 'Pickup address is default is required.',
        ];
    }
}
