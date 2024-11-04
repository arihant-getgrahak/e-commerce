<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\GuestAddress;
use App\Models\GuestOrder;
use App\Models\Order;
use App\Models\OrderAdress;
use App\Models\OrderProduct;
use App\Models\SessionCart;
use App\Models\SessionOrder;
use DB;
use Illuminate\Http\Request;

class CheckoutController extends Controller
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
                $price = $cart->sum('price');
            }
        } else {
            $cart = Cart::where('user_id', auth()->user()->id)->with('products')->get();
            $price = 0;
            if ($cart) {
                $price = $cart->sum('price');
            }
        }

        return view('checkout', compact('isLoggedIn', 'cart', 'price'));
    }

    public function display()
    {
        $orders = Order::where('user_id', auth()->user()->id)->get();

        return view('orderdisplay', compact('orders'));
    }

    public function store(Request $request)
    {
        try {
            $isloggedIn = auth()->check();

            if ($isloggedIn) {
                $cart = Cart::where('user_id', auth()->user()->id)->with('products')->get();

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
                    'user_id' => auth()->user()->id,
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
                    'user_id' => auth()->user()->id,
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

                Cart::where('user_id', auth()->user()->id)->delete();

                return view('order-confirm')->with('orderId', $order->id);
            } else {
                $sessionIds = session()->getId();
                $cart = SessionCart::where('session_id', $sessionIds)->with('products')->get();

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
                $order = GuestAddress::create([
                    'session_id' => $sessionIds,
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
                $order = SessionOrder::create([
                    'session_id' => $sessionIds,
                    'address_id' => $order->id,
                    'total' => $price,
                    'payment_method' => $request->payment_method,
                ]);

                DB::commit();
                foreach ($cart as $c) {
                    GuestOrder::create([
                        'order_id' => $order->id,
                        'product_id' => $c->product_id,
                        'quantity' => $c->quantity,
                        'price' => $c->price,
                    ]);
                }

                SessionCart::where('session_id', $sessionIds)->delete();

                return view('order-confirm')->with('orderId', $order->id);
            }
        } catch (\Exception $e) {
            DB::rollBack();

            return back()->with('error', $e->getMessage());
        }
    }
}
