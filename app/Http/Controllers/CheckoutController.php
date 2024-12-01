<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderAdress;
use App\Models\OrderProduct;
use App\Models\OrderStatus;
use App\Models\SessionCart;
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
                        'name' => $sc->name,
                        'currency_code' => $sc->currency_code,
                    ]);
                }
                SessionCart::where('session_id', $sessionIds)->delete();
            }

            if (auth()->check()) {
                $cart = Cart::where('user_id', auth()->user()->id)->with('products')->get();

                if (count($cart) == 0) {
                    return back()->with('error', 'Cart is empty');
                }

                $price = $cart->sum('price');
                $currency_code = $cart[0]->currency_code;

                DB::beginTransaction();
                $billingAddress = OrderAdress::create([
                    'user_id' => auth()->user()->id,
                    'name' => "{$request->fname} {$request->lname}",
                    'email' => $request->email,
                    'address' => "{$request->address1}, {$request->address2}",
                    'city' => $request->city,
                    'state' => $request->state,
                    'country' => $request->country,
                    'pincode' => $request->pincode,
                    'phone' => $request->ccode + $request->phone,
                    'is_default' => $request->is_default ?? false,
                    'type' => 'billing',
                ]);

                $shippingAddress = null;
                if ($request->shipping) {
                    $shippingAddress = OrderAdress::create([
                        'user_id' => auth()->user()->id,
                        'name' => "{$request->sfname} {$request->slname}",
                        'email' => $request->semail,
                        'address' => "{$request->saddress1}, {$request->saddress2}",
                        'city' => $request->scity,
                        'state' => $request->sstate,
                        'country' => $request->scountry,
                        'pincode' => $request->spincode,
                        'phone' => $request->ccode + $request->sphone,
                        'is_default' => $request->sis_default ?? false,
                        'type' => 'shipping',
                    ]);
                }
                DB::commit();

                DB::beginTransaction();

                $order = Order::create([
                    'user_id' => auth()->user()->id,
                    'address_id' => $billingAddress->id,
                    'shipping_address' => $shippingAddress->id ?? null,
                    'total' => $price,
                    'payment_method' => $request->payment_method,
                    'currency_code' => $currency_code,
                ]);

                OrderStatus::create([
                    'order_id' => $order->id,
                    'status' => 'pending',
                ]);

                DB::commit();

                DB::beginTransaction();
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

                Cart::where('user_id', auth()->user()->id)->delete();

                return view('order-confirm')->with('orderId', $order->id);
            }

            $sessionIds = session()->getId();
            $cart = SessionCart::where('session_id', $sessionIds)->with('products')->get();

            $price = $cart->sum('price');
            $currency_code = $cart[0]->currency_code;

            DB::beginTransaction();
            $billingAddress = OrderAdress::create([
                'session_id' => $sessionIds,
                'name' => "{$request->fname} {$request->lname}",
                'email' => $request->email,
                'address' => "{$request->address1}, {$request->address2}",
                'city' => $request->city,
                'state' => $request->state,
                'country' => $request->country,
                'pincode' => $request->pincode,
                'phone' => $request->ccode + $request->phone,
                'is_default' => $request->is_default ?? false,
                'type' => 'billing',
            ]);

            $shippingAddress = null;
            if ($request->shipping) {
                $shippingAddress = OrderAdress::create([
                    'session_id' => $sessionIds,
                    'name' => "{$request->sfname} {$request->slname}",
                    'email' => $request->semail,
                    'address' => "{$request->saddress1}, {$request->saddress2}",
                    'city' => $request->scity,
                    'state' => $request->sstate,
                    'country' => $request->scountry,
                    'pincode' => $request->spincode,
                    'phone' => $request->ccode + $request->sphone,
                    'is_default' => $request->sis_default ?? false,
                    'type' => 'shipping',
                ]);
            }
            DB::commit();

            DB::beginTransaction();
            $order = Order::create([
                'session_id' => $sessionIds,
                'address_id' => $billingAddress->id,
                'shipping_address' => $shippingAddress->id ?? null,
                'total' => $price,
                'payment_method' => $request->payment_method,
                'currency_code' => $currency_code,
            ]);

            OrderStatus::create([
                'order_id' => $order->id,
                'status' => 'pending',
            ]);

            DB::commit();

            DB::beginTransaction();
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

            Cart::where('session_id', $sessionIds)->delete();

            return view('order-confirm')->with('orderId', $order->id);

        } catch (\Exception $e) {
            DB::rollBack();

            return back()->with('error', $e->getMessage());
        }
    }
}
