<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderAdress;
use App\Models\OrderProduct;
use DB;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function index()
    {
        return view('checkout');
    }

    public function store(Request $request)
    {
        try {
            // $isloggedIn = auth()->check();
            $isloggedIn = true;

            if ($isloggedIn) {
                // $cart = Cart::where('user_id', auth()->user()->id)->with('products')->get();
                $cart = Cart::where('user_id', 1)->with('products')->get();
                if (! $cart) {
                    return response()->json([
                        'message' => 'Cart is empty',
                        'status' => false,
                    ], 404);
                }

                $price = $cart->sum('price');

                DB::beginTransaction();
                $name = $request->fname.' '.$request->lname;
                $address = $request->address1;
                if ($request->address2) {
                    $address = $address.', '.$request->address2;
                }

                // create order address
                $order = OrderAdress::create([
                    'user_id' => 1,
                    'name' => $name,
                    'email' => $request->email,
                    'address' => $address,
                    'city' => $request->city,
                    'state' => $request->state,
                    'country' => $request->country,
                    'pincode' => $request->pincode,
                    'phone' => $request->phone,

                ]);

                // create order
                $order = Order::create([
                    'user_id' => 1,
                    'address_id' => $order->id,
                    'total' => $price,
                    'payment_method' => $request->payment_method,
                ]);

                foreach ($cart as $c) {
                    OrderProduct::create([
                        'order_id' => $order->id,
                        'product_id' => $c->product_id,
                        'quantity' => $c->quantity,
                        'price' => $c->price,
                    ]);
                }

                DB::commit();

                $order = Order::with(['products.product', 'address'])->first();

                Cart::where('user_id', 1)->delete();

                return back()->with('success', 'Order placed successfully');
            } else {
                return back()->with('error', 'Please login first');
            }
        } catch (\Exception $e) {
            DB::rollBack();

            return back()->with('error', $e->getMessage());
        }
    }
}