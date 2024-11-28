<?php

namespace App\Http\Controllers;

use App\Http\Requests\PickupAddressRequest;
use App\Http\Requests\PickupAddressUpdateRequest;
use App\Models\PickupAddress;
use DB;
use Http;

class PickupAddressController extends Controller
{
    public function index()
    {
        if (! auth()->check()) {
            return redirect()->route('login');
        }

        $data = $this->getPickupAddress();

        if ($data !== true) {
            echo $data;
        }

        $addresses = PickupAddress::where('user_id', auth()->id())
            ->orderBy('created_at', 'desc')
            ->paginate(5);

        return view('admin.pickupaddress', ['addresses' => $addresses]);
    }

    public function store(PickupAddressRequest $request)
    {
        try {
            $data = [
                'user_id' => auth()->user()->id,
                'name' => $request->name,
                'tag' => $request->tag,
                'email' => $request->email,
                'phone' => $request->phone,
                'address' => $request->address,
                'city' => $request->city,
                'state' => $request->state,
                'pincode' => $request->pincode,
                'country' => $request->country,
                'is_default' => $request->is_default,
            ];

            $res = Http::withHeaders([
                'Content-Type' => 'application/json',
                'Authorization' => 'Bearer '.env('SHIPROCKET_TOKEN'),
            ])->post('https://apiv2.shiprocket.in/v1/external/settings/company/addpickup', [
                'pickup_location' => $request->tag,
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'address' => $request->address,
                'city' => $request->city,
                'state' => $request->state,
                'country' => $request->country,
                'pin_code' => $request->pincode,
            ]);

            if (! $res->successful()) {
                $error = $res->json()['errors']['address'][0] ?? $res->json()['errors']['pickup_location'][0];

                return back()->with('error', $error);
            }

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
                'tag',
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

    protected function getPickupAddress()
    {
        try {
            $address = Http::withHeaders([
                'Content-Type' => 'application/json',
                'Authorization' => 'Bearer '.env('SHIPROCKET_TOKEN'),
            ])->get('https://apiv2.shiprocket.in/v1/external/settings/company/pickup');

            DB::beginTransaction();
            foreach ($address->json()['data']['shipping_address'] as $key => $value) {
                PickupAddress::updateOrCreate(
                    [
                        'tag' => $value['pickup_location'],
                    ],
                    [
                        'user_id' => auth()->user()->id,
                        'name' => $value['name'],
                        'email' => $value['email'],
                        'phone' => $value['phone'],
                        'address' => $value['address'].' '.$value['address_2'],
                        'city' => $value['city'],
                        'state' => $value['state'],
                        'pincode' => $value['pin_code'],
                        'country' => $value['country'],
                        'is_default' => $value['is_primary_location'],
                    ]
                );
            }

            DB::commit();

            return true;

        } catch (\Exception $e) {
            DB::rollBack();

            return $e->getMessage();
        }
    }
}
