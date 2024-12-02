<?php

namespace App\Http\Controllers;

use App\Http\Requests\CartStoreRequest;
use App\Models\Cart;
use App\Models\SessionCart;
use App\Models\Store;
use DB;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        $isLoggedIn = auth()->check();
        $price = 0;
        $cart = null;

        if (! $isLoggedIn) {
            $session_id = session()->getId();
            $cart = SessionCart::where('session_id', $session_id)->with('products')->get();
            if ($cart) {
                $price = round($cart->sum('price'), 2);
            }
        } else {
            $cart = Cart::where('user_id', auth()->user()->id)->with('products')->get();
            $price = 0;
            if ($cart) {
                $price = round($cart->sum('price'), 2);
            }
        }

        $store = Store::first();
        $tax_value = $store->tax_value;
        $finalprice = $price;
        if ($store->tax_type == 'inclusive') {
            $finalprice = $price;
            $price = round($price - ($price * $store->tax_value / 100), 2);
        } else {
            $finalprice = round($price + ($price * $store->tax_value / 100), 2);
        }

        return view('shopping-cart', compact('isLoggedIn', 'cart', 'price', 'tax_value', 'finalprice'));
    }

    public function cartcount()
    {
        $isLoggedIn = auth()->check();
        $price = 0;
        $cart = null;
        $country = 'INR';

        if (! $isLoggedIn) {
            $session_id = session()->getId();
            $cart = SessionCart::where('session_id', $session_id)->with('products')->get();
            $country = SessionCart::where('session_id', $session_id)->with('products')->first();
            if ($cart) {
                $price = round($cart->sum('price'), 2);
            }
        } else {
            $cart = Cart::where('user_id', auth()->user()->id)->with('products')->get();
            $country = Cart::where('user_id', auth()->user()->id)->with('products')->first();
            $price = 0;
            if ($cart) {
                $price = round($cart->sum('price'), 2);
            }
        }

        return response()->json(['cart' => $cart, 'price' => $price, 'country' => $country->currency_code]);
    }

    public function store(CartStoreRequest $request)
    {
        if (auth()->check()) {
            $cart = Cart::where('user_id', auth()->user()->id)->where('product_id', $request->product_id)->first();
            if ($cart) {

                $cart->update([
                    'quantity' => $request->quantity,
                    'price' => $request->price * $request->quantity,
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
                'name' => $request->name,
                'currency_code' => $request->currency,
            ];

            $cart = Cart::create($data);

            if (! $cart) {
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

        $session_id = session()->getId();

        $cart = SessionCart::where('session_id', $session_id)->where('product_id', $request->product_id)->first();
        if ($cart) {

            $cart->update([
                'quantity' => $request->quantity,
                'price' => $request->price * $request->quantity,
                'name' => $request->name,
                'currency_code' => $request->currency,
            ]);

            return response()->json([
                'status' => true,
                'message' => 'Cart created successfully',
            ], 200);
        }
        $data = [
            'session_id' => $session_id,
            'product_id' => $request->product_id,
            'quantity' => $request->quantity,
            'price' => $request->price * $request->quantity,
            'name' => $request->name,
            'currency_code' => $request->currency,
        ];

        $cart = SessionCart::create($data);

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

    public function update(Request $request)
    {
        if (auth()->check()) {
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
        } else {
            $cartData = $request->all();

            $cartIds = array_keys($cartData);

            $session_id = session()->getId();

            $carts = SessionCart::whereIn('id', $cartIds)->get()->keyBy('id');

            if ($carts->isEmpty()) {
                return response()->json([
                    'message' => 'No cart items found',
                    'status' => false,
                ], 404);
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
    }

    public function destroy($id)
    {
        if (auth()->check()) {
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
        } else {
            $cart = SessionCart::find($id);
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
}
