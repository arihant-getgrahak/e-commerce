<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use DB;
use Request;

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
                $orderData = [];
                $price = 0;
                foreach ($cart as $c) {
                    $price += $c->price;
                }
                DB::beginTransaction();
                foreach ($cart as $c) {
                    $order = Order::create([
                        'user_id' => 1,
                        'products' => json_encode($c->products),
                        'address' => json_encode($request->address),
                        'total' => $price,
                        'payment_method' => $request->payment_method,
                    ]);

                    $orderData[] = $order;
                }

                DB::commit();

                return response()->json([
                    'message' => 'Order placed successfully',
                    'status' => true,
                    'data' => $orderData,
                ]);

                // Cart::where('user_id', auth()->user()->id)->delete();
                // return response()->json([
                //     'message' => 'Order placed successfully',
                //     'status' => true,
                //     'data' => $orderData,
                // ]);
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
