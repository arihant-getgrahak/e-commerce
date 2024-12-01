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
        $navigation = Navigation::with([
            'menus' => function ($query) {
                $query->whereNull('parent_id')->orderBy('orders');
            },
            'menus.children' => function ($query) {
                $query->orderBy('orders');
            },
        ])->get();

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

    public function changeOrder(Request $request)
    {
        $ids = $request->orderedIds;
        foreach ($ids as $key => $id) {
            $menu = NavigationMenu::find($id);
            $menu->orders = $key;
            $menu->save();
        }

        return response()->json(['success' => true]);
    }
}
