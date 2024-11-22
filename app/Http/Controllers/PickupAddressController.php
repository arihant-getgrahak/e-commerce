<?php

namespace App\Http\Controllers;

use App\Http\Requests\PickupAddressRequest;
use App\Models\PickupAddress;

class PickupAddressController extends Controller
{
    public function index()
    {
        return view('admin.pickupaddress');
    }

    public function store(PickupAddressRequest $request)
    {
        $data = [
            'user_id' => auth()->user()->id,
            'name' => $request->name,
            'phone' => $request->phone,
            'address' => $request->address,
            'city' => $request->city,
            'state' => $request->state,
            'pincode' => $request->pincode,
            'country' => $request->country,
        ];

        $create = PickupAddress::create($data);

        if (! $create) {
            return back()->with('error', 'Pickup address not created');
        }

        return back()->with('success', 'Pickup address created');
    }
}
