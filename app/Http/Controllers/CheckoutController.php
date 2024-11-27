<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\GuestAddress;
use App\Models\GuestOrder;
use App\Models\Order;
use App\Models\OrderAdress;
use App\Models\OrderProduct;
use App\Models\OrderStatus;
use App\Models\SessionCart;
use App\Models\SessionOrder;
use App\Models\User;
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

        $country = 'IN';

        if (! session()->has('country')) {
            if (auth()->check()) {
                session()->put('country', auth()->user()->country);
            } else {
                $ip = request()->ip() ?? '146.70.245.84';
                $data = getLocationInfo($ip);
                $country = $data['data']['country'] ?? $country;
                session()->put('country', $country);
            }
        }

        $country = session('country', 'IN');
        $telcode = getTelCode($country)['code'];

        return view('checkout', compact('isLoggedIn', 'cart', 'price', 'telcode'));
    }

    public function display()
    {
        if (! auth()->check()) {
            return redirect()->route('login');
        }
        $orders = Order::where('user_id', auth()->user()->id)->with('products.product')->get();

        return view('orderdisplay', compact('orders'));
    }

    public function store(Request $request)
    {
        try {
            if ($request->password) {
                $sessionIds = session()->getId();
                $user = User::create([
                    'name' => $request->fname.' '.$request->lname,
                    'email' => $request->email,
                    'password' => bcrypt($request->password),
                    'role' => $request->role ?? 'user',
                    'country_code' => $request->country,
                    'phone_number' => $request->phone,
                ]);

                \Auth::login($user);
                $sessioncart = SessionCart::where('session_id', $sessionIds)->get();

                foreach ($sessioncart as $sc) {
                    Cart::create([
                        'user_id' => $user->id,
                        'product_id' => $sc->product_id,
                        'quantity' => $sc->quantity,
                        'price' => $sc->price,
                    ]);
                }
                SessionCart::where('session_id', $sessionIds)->delete();
            }
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
                    'phone' => $request->ccode + $request->phone,
                ]);

                // create order
                $order = Order::create([
                    'user_id' => auth()->user()->id,
                    'address_id' => $order->id,
                    'total' => $price,
                    'payment_method' => $request->payment_method,
                ]);

                OrderStatus::create([
                    'order_id' => $order->id,
                    'status' => 'pending',
                ]);

                foreach ($cart as $c) {
                    OrderProduct::create([
                        'order_id' => $order->id,
                        'product_id' => $c->product_id,
                        'quantity' => $c->quantity,
                        'price' => $c->price,
                        'name' => $c->name,
                    ]);
                }

                DB::commit();

                $order = Order::with(['products.product', 'address'])->where('id', $order->id)->first();

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

                OrderStatus::create([
                    'order_id' => $order->id,
                    'status' => 'pending',
                ]);

                DB::commit();
                foreach ($cart as $c) {
                    GuestOrder::create([
                        'order_id' => $order->id,
                        'product_id' => $c->product_id,
                        'quantity' => $c->quantity,
                        'price' => $c->price,
                        'name' => $c->name,
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
