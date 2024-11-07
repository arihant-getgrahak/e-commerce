<?php

namespace App\Http\Controllers;

use App\Models\Attributes;
use Request;
use Validator;

class AttributeController extends Controller
{
    public function index()
    {
        $attributes = Attributes::with('values')->get();

        return view('attribute', compact('attributes'));
    }

    public function store(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'name' => 'required',
        ]);

        if ($validation->fails()) {
            return back()->with('errors', $validation->errors());
        }

        $attribute = Attributes::create([
            'name' => $request->name,
        ]);

        if (! $attribute) {
            return back()->with('error', 'Attribute not created');
        }

        return back()->with('success', 'Attribute created successfully');
    }
}
