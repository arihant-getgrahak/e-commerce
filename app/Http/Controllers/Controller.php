<?php

namespace App\Http\Controllers;

use App\Models\Navigation;
use View;

abstract class Controller
{
    public function __construct()
    {
        $navigation = Navigation::with('menus.children')->get();
        foreach ($navigation as $n) {
            $n->menus = $n->menus->whereNull('parent_id');
        }
        // $ip = request()->ip();
        $ip = '146.70.245.84';
        $data = getLocationInfo($ip);
        $telcode = $data['data']['country'] ?? 'IN';

        View::share('navigations', [$navigation, $telcode]);
    }
}
