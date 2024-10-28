<?php

namespace App\Http\Controllers;

use App\Http\Requests\CartStoreRequest;
use App\Models\Cart;
use DB;
use Request;

class CartController extends Controller
{
    public function index()
    {
        $isLoggedIn = auth()->check();
        $cart = $isLoggedIn ? Cart::where('user_id', auth()->user()->id)->with('products')->get() : null;

        return view('shopping-cart', compact('isLoggedIn', 'cart'));
    }

    public function store(CartStoreRequest $request)
    {
        $cart = Cart::where('user_id', auth()->user()->id)->where('product_id', $request->product_id)->first();
        if ($cart) {
            $cart->update([
                'quantity' => $cart->quantity + $request->quantity,
            ]);

            return response()->json([
                'status' => true,
                'message' => 'Cart created successfully',
            ], 200);
        }
        $data = [
            'user_id' => auth()->user()->id,
            'product_id' => $request->product_id,
            'quantity' => $request->quantity,
            'price' => $request->price,
        ];

        $cart = Cart::create($data);

        if (! $cart) {
            // return back()->with('error', 'Cart not created');
            return response()->json([
                'message' => 'Cart not created',
                'status' => false,
            ], 500);
        }

        // return back()->with('success', 'Cart created successfully');
        return response()->json([
            'status' => true,
            'message' => 'Cart created successfully',
        ], 200);
    }

    public function update(Request $request, $id)
    {
        try {
            $cart = Cart::find($id);

            if (! $cart) {
                return back()->with('error', 'Cart not found');
            }
            DB::beginTransaction();
            $cart->update([
                'quantity' => $request->quantity,
            ]);

            DB::commit();

            return response()->json([
                'message' => 'Cart updated successfully',
                'status' => true,
            ]);

        } catch (\Exception $e) {
            DB::rollBack();

            // return back()->with('error', $e->getMessage());

            return response()->json([
                'message' => $e->getMessage(),
                'status' => false,
            ]);
        }
    }

    public function destroy($id)
    {
        $cart = Cart::find($id);
        if ($cart) {
            $cart->delete();

            return back()->with('success', 'Cart deleted successfully');
        }

        return back()->with('error', 'Cart not found');
    }
}
