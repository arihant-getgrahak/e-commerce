<?php

namespace App\Http\Controllers;

use App\Http\Requests\CartStoreRequest;
use App\Models\Cart;
use DB;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        $isLoggedIn = auth()->check();
        $cart = $isLoggedIn ? Cart::where('user_id', auth()->user()->id)->with('products')->get() : null;
        $price = 0;
        if ($cart) {
            foreach ($cart as $c) {
                $price += $c->price;
            }
        }

        return view('shopping-cart', compact('isLoggedIn', 'cart', 'price'));
    }

    public function cartcount()
    {
        $isLoggedIn = auth()->check();
        $cart = $isLoggedIn ? Cart::where('user_id', auth()->user()->id)->with('products')->get() : null;
        $price = 0;
        if ($cart) {
            $price = $cart->sum('price');
        }

        return response()->json(['cart' => $cart, 'price' => $price]);
    }

    public function store(CartStoreRequest $request)
    {
        if (auth()->check()) {
            $cart = Cart::where('user_id', auth()->user()->id)->where('product_id', $request->product_id)->first();
            if ($cart) {
                $newQuantity = $cart->quantity + $request->quantity;
                $cart->update([
                    'quantity' => $newQuantity,
                    'price' => $request->price * $newQuantity,
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
                'price' => $request->price * $request->quantity,
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

        $cart = session()->get('cart', []);
        $productId = $request->product_id;

        if (isset($cart[$productId])) {
            $cart[$productId]['quantity'] += $request->quantity;
            $cart[$productId]['price'] = $request->price * $cart[$productId]['quantity'];
        } else {
            $cart[$productId] = [
                'user_id' => null,
                'product_id' => $request->product_id,
                'quantity' => $request->quantity,
                'price' => $request->price * $request->quantity,
            ];
        }

        session()->put('cart', $cart);

        return response()->json([
            'status' => true,
            'message' => 'Cart created successfully',
        ], 200);

    }

    public function update(Request $request)
    {
        $cartData = $request->all();

        $cartIds = array_keys($cartData);

        $carts = Cart::whereIn('id', $cartIds)->get()->keyBy('id');

        if ($carts->isEmpty()) {
            return response()->json([
                'message' => 'No cart items found',
                'status' => false,
            ]);
        }

        try {
            DB::beginTransaction();

            foreach ($cartData as $id => $data) {
                if (! isset($carts[$id])) {
                    continue;
                }

                $cart = $carts[$id];
                $pricePerUnit = $cart->price / $cart->quantity;

                $cart->update([
                    'quantity' => $data['quantity'],
                    'price' => $pricePerUnit * $data['quantity'],
                ]);
            }

            DB::commit();

            return response()->json([
                'message' => 'Cart updated successfully',
                'status' => true,
                'data' => $carts->values(),
            ]);
        } catch (\Exception $e) {
            DB::rollBack();

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

            // return back()->with('success', 'Cart deleted successfully');
            return response()->json([
                'message' => 'Cart deleted successfully',
                'status' => true,
            ], 200);
        }

        // return back()->with('error', 'Cart not found');
        return response()->json([
            'message' => 'Cart not found',
            'status' => false,
        ], 404);
    }
}
