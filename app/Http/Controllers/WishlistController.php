<?php

namespace App\Http\Controllers;

use App\Models\Wishlist;
use Illuminate\Http\Request;

class WishlistController extends Controller
{
    public function index()
    {
        $wishlist = Wishlist::where('user_id', auth()->user()->id)->get();

        return view('wishlist', compact('wishlist'));
    }

    public function store(Request $request)
    {
        $isLoggedIn = auth()->check();

        if ($isLoggedIn) {
            $wishlist = Wishlist::create([
                'user_id' => auth()->user()->id,
                'product_id' => $request->product_id,
            ]);

            if ($wishlist) {
                return redirect()->back()->with('success', 'Product added to wishlist');
            } else {
                return redirect()->back()->with('error', 'Something went wrong');
            }
        }

        return redirect()->back()->with('error', 'Please login first');
    }
}
