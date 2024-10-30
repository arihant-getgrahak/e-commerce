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
        // return $request->all();
        /* TODO: Add steps to checkout
            1. Fetch cart items from database if user is login
            2. If user is not login, fetch cart items from session
            3. Pass cart items to checkout view
            4. Store checkout data to database
            5. Redirect to thank-you page and show status
            6. Handle exceptions
        */

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

                // create order address
                $order = OrderAdress::create([
                    'user_id' => 1,
                    'name' => $request->name,
                    'email' => $request->email,
                    'address' => $request->address,
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

                return response()->json([
                    'message' => 'Order placed successfully',
                    'status' => true,
                    'data' => $order,
                ]);
            } else {
                return response()->json([
                    'message' => 'Please login...',
                    'status' => false,
                ]);
            }
        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json([
                'message' => 'Something went wrong',
                'data' => $e->getMessage(),
                'status' => false,
            ]);
        }
    }
}
