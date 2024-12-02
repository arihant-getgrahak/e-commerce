<?php

namespace App\Http\Controllers;

use App\Models\Navigation;
use Cache;
use View;

abstract class Controller
{
    public function __construct()
    {
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
        // $data = [
        //     'delivery' => 2000,
        //     'currency' => '₹',
        // ];

        View::share('navigations', compact('navigation', 'telcode', 'data'));
    }
}
