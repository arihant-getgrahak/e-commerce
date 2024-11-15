<?php

namespace App\Http\Controllers;

use App\Models\Navigation;

class NavigationController extends Controller
{
    public function index()
    {
        $navigation = Navigation::with('menus.children')->get();
        foreach ($navigation as $n) {
            $n->menus = $n->menus->whereNull('parent_id');
        }

        return view('navigation', compact('navigation'));
    }
}
