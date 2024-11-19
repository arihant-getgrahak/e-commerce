<?php

namespace App\Http\Controllers;

use App\Models\Navigation;
use App\Models\NavigationMenu;
use Illuminate\Http\Request;
use Validator;

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

    public function getLinks($id)
    {
        $links = NavigationMenu::where('navigation_id', $id)->whereNull('parent_id')->get();

        if ($links) {
            return response()->json(['links' => $links], 200);
        }

        return response()->json(['links' => []], 400);
    }

    public function store(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'name' => 'required',
            'parent_id' => 'nullable|exists:navigation_menus,id',
            'navigation_id' => 'required|exists:navigations,id',
            'link' => 'required',
        ]);

        if ($validate->fails()) {
            return back()->with('errors', $validate->errors());
        }
        $data = [
            'user_id' => auth()->user()->id,
            'navigation_id' => $request->navigation_id,
            'parent_id' => $request->parent_id ?? null,
            'name' => $request->name,
            'link' => $request->link,
        ];
        NavigationMenu::create($data);

        return back()->with('success', 'Navigation menu created successfully');
    }

    public function addMenu(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'name' => 'required|unique:navigations,name',
            'navigation_id' => 'required|exists:navigations,id',
        ]);

        if ($validate->fails()) {
            return back()->with('errors', $validate->errors());
        }
        $data = [
            'name' => $request->name,
        ];
        Navigation::create($data);

        return back()->with('success', 'Navigation created successfully');
    }
}
