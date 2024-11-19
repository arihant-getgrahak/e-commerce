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

        // view()->share('navigations', $navigation);
        View::share('navigations', $navigation);
    }
}
