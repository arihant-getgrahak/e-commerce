<?php

namespace App\Http\Controllers;

use App\Models\Navigation;

class NavigationController extends Controller
{
    public function index()
    {
        $navigation = Navigation::with('menus.children')->get();

        return view('navigation', compact('navigation'));
    }
}
