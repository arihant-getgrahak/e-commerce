<?php

namespace App\Http\Controllers;

use App\Models\Navigation;
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
        $exchangeRate = getExchangeRate($country);

        $data = [
            'delivery' => (float) '2000' * (float) $exchangeRate['data'],
            'currency' => $exchangeRate['currency'],
        ];

        View::share('navigations', compact('navigation', 'telcode', 'data'));
    }
}
