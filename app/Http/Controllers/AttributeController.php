<?php

namespace App\Http\Controllers;

use App\Models\attribute_value;
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

    public function storeAttributeValues(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'attribute_id' => 'required|exists:attributes,id',
            'value' => 'required',
        ]);

        if ($validation->fails()) {
            return back()->with('errors', $validation->errors());
        }

        $attribute = attribute_value::create([
            'attribute_id' => $request->attribute_id,
            'value' => $request->value,
        ]);

        if (! $attribute) {
            return back()->with('error', 'Attribute not created');
        }

        return back()->with('success', 'Attribute created successfully');
    }

    public function destroy($id)
    {
        $attribute = Attributes::find($id);
        $attribute->delete();

        return back()->with('success', 'Attribute deleted successfully');
    }

    public function destroyAttributeValues($id)
    {
        $attribute = attribute_value::find($id);
        $attribute->delete();

        return back()->with('success', 'Attribute deleted successfully');
    }

    public function update(Request $request, $id)
    {
        $attribute = Attributes::find($id);

        $attribute->update([
            'name' => $request->name,
        ]);
    }

    public function updateAttributeValues(Request $request, $id)
    {
        $attribute = attribute_value::find($id);

        $attribute->update([
            'value' => $request->value,
        ]);
    }
}
