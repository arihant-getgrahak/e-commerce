<?php

namespace App\Http\Controllers;

use App\Http\Requests\PickupAddressRequest;
use App\Http\Requests\PickupAddressUpdateRequest;
use App\Models\PickupAddress;
use DB;

class PickupAddressController extends Controller
{
    public function index()
    {
        if (! auth()->check()) {
            return redirect()->route('login');
        }
        $addresses = PickupAddress::where('user_id', auth()->user()->id)->paginate(5);

        return view('admin.pickupaddress', ['addresses' => $addresses]);
    }

    public function store(PickupAddressRequest $request)
    {
        try {
            $data = [
                'user_id' => auth()->user()->id,
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'address' => $request->address,
                'city' => $request->city,
                'state' => $request->state,
                'pincode' => $request->pincode,
                'country' => $request->country,
                'is_default' => $request->is_default,
            ];

            DB::beginTransaction();
            PickupAddress::create($data);
            DB::commit();

            return back()->with('success', 'Pickup address created');
        } catch (\Exception $e) {
            DB::rollBack();

            return back()->with('error', $e->getMessage());
        }
    }

    public function update($id, PickupAddressUpdateRequest $request)
    {
        try {
            $update = PickupAddress::where('id', $id);
            if (! $update) {
                return back()->with('error', 'Pickup address not found');
            }
            $data = $request->only([
                'name',
                'phone',
                'address',
                'city',
                'state',
                'pincode',
                'country',
                'is_default',
                'email',
            ]);

            DB::beginTransaction();
            $update->update($data);
            DB::commit();

            return back()->with('success', 'Pickup address updated');
        } catch (\Exception $e) {
            DB::rollBack();

            return back()->with('error', $e->getMessage());
        }
    }

    public function delete($id)
    {
        try {
            $update = PickupAddress::where('id', $id);
            if (! $update) {
                return back()->with('error', 'Pickup address not found');
            }

            DB::beginTransaction();
            $update->delete();
            DB::commit();

            return back()->with('success', 'Pickup address deleted');
        } catch (\Exception $e) {
            DB::rollBack();

            return back()->with('error', $e->getMessage());
        }
    }
}
