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
        return view('cart');
    }

    public function store(CartStoreRequest $request)
    {
        $data = [
            'user_id' => auth()->user()->id,
            'product_id' => $request->product_id,
            'quantity' => $request->quantity,
            'price' => $request->price,
        ];

        $cart = Cart::create($data);

        if (! $cart) {
            return back()->with('error', 'Cart not created');
        }

        return back()->with('success', 'Cart created successfully');
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

        } catch (\Exception $e) {
            DB::rollBack();

            return back()->with('error', $e->getMessage());
        }
    }
}
