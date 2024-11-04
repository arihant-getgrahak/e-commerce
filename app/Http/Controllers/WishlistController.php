<?php

namespace App\Http\Controllers;

use App\Models\Wishlist;
use Illuminate\Http\Request;

class WishlistController extends Controller
{
    public function index()
    {
        $wishlist = Wishlist::where('user_id', auth()->user()->id)->with('product')->get();

        return view('wishlist', compact('wishlist'));
    }

    public function store(Request $request)
    {
        $isLoggedIn = auth()->check();

        if ($isLoggedIn) {
            $checkWishlist = Wishlist::where('user_id', auth()->user()->id)->where('product_id', $request->product_id)->first();
            if ($checkWishlist) {
                return response()->json([
                    'status' => false,
                    'message' => 'Product already in wishlist',
                ], 400);
            }

            $wishlist = Wishlist::create([
                'user_id' => auth()->user()->id,
                'product_id' => $request->product_id,
            ]);

            if ($wishlist) {
                return response()->json([
                    'status' => true,
                    'message' => 'Product added to wishlist successfully',
                ], 200);
            } else {
                return response()->json([
                    'status' => false,
                    'message' => 'Product not added to wishlist',
                ], 400);
            }
        }

        return response()->json([
            'status' => false,
            'message' => 'Please login first',
        ], 401);
    }

    public function destroy($id)
    {
        $wishlist = Wishlist::find($id);
        if ($wishlist) {
            $wishlist->delete();

            return response()->json([
                'status' => true,
                'message' => 'Product removed from wishlist successfully',
            ], 200);
        }

        return response()->json([
            'status' => false,
            'message' => 'Product not removed from wishlist',
        ], 400);
    }
}
