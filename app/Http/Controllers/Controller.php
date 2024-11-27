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
                $query->whereNull('parent_id')->with('children');
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

        View::share('navigations', compact('navigation', 'telcode'));
    }
}
