<?php

namespace App\Http\Controllers;

use App\Models\Language;
use App\Models\Navigation;
use App\Models\PickupAddress;
use Cache;
use DB;
use Http;
use View;

abstract class Controller
{
    public function __construct()
    {

        $data = $this->getPickupAddress();

        // if ($data !== true) {
        //     echo $data;
        // }
        $navigation = Navigation::with([
            'menus' => function ($query) {
                $query->whereNull('parent_id')->orderBy('orders');
            },
            'menus.children' => function ($query) {
                $query->orderBy('orders');
            },
        ])->get();

        $telcode = 'IN';

        if (! session()->has('country')) {
            if (auth()->check()) {
                session()->put('country', auth()->user()->country);
            } else {
                $ip = request()->ip() ?? '146.70.245.84';
                $data = getLocationInfo($ip);
                $country = $data['data']['country'] ?? $telcode;
                session()->put('country', $country);
            }
        }

        $telcode = session('country', 'IN');

        $country = session('country');

        $exchangeRate = Cache::remember('exchangeRate', now()->addHours(24), function () {
            return getExchangeRate();
        });

        $currencyInfo = Cache::remember('currencyInfo', now()->addHours(24), function () use ($country) {
            return getCurrencySymbol($country);
        });

        $currencySymbol = $currencyInfo['data'] ?? null;
        $currencyCode = $currencyInfo['currency_code'] ?? null;

        $exchangeRateForCurrency = $exchangeRate['data'][$currencyCode] ?? 1;

        $data = [
            'delivery' => (float) '2000' * (float) $exchangeRateForCurrency,
            'currency' => $currencySymbol ?? '₹',
        ];

        $lang = $this->fetchLang();

        View::share('navigations', compact('navigation', 'telcode', 'data', 'lang'));
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

    protected function fetchLang()
    {
        $lang = Language::all();

        return $lang;
    }
}
