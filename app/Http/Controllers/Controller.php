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

        $telcode = session('country', 'IN');
        if (auth()->check()) {
            $telcode = auth()->user()->country ?? $telcode;
        } elseif (! session('country')) {
            $ip = request()->ip() ?? '146.70.245.84';
            $data = getLocationInfo($ip);
            $telcode = $data['data']['country'] ?? $telcode;
        }

        View::share('navigations', compact('navigation', 'telcode'));
    }
}
