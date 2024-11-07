<?php

namespace App\Http\Controllers;

use App\Models\Attributes;

class AttributeController extends Controller
{
    public function index()
    {
        $attributes = Attributes::with('values')->get();

        return view('attribute', compact('attributes'));
    }
}
