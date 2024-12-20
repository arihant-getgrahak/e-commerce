<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderAdress;
use App\Models\OrderProduct;
use App\Models\OrderStatus;
use App\Models\SessionCart;
use App\Models\Store;
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

        $store = Store::first();
        $tax_value = $store->tax_value;
        if (! $isLoggedIn) {
            $session_id = session()->getId();
            $cart = SessionCart::where('session_id', $session_id)->with('products')->get();
            $subtotal = 0;
            $tax = 0;
            if ($cart) {
                foreach ($cart as $cartItem) {
                    foreach ($cartItem->products as $product) {
                        $productPrice = $cartItem->price;
                        $taxValue = $product->tax_value;
                        $taxType = $product->tax_type;

                        if ($taxType === 'exclusive') {
                            $subtotal += $productPrice;
                            $tax = $tax + ($productPrice * ($taxValue / 100));
                        } else {
                            $subtotal += $productPrice - ($taxValue / 100);
                            $tax = $tax + ($productPrice * ($taxValue / (100 + $taxValue)));
                        }
                    }
                }
            }

        } else {
            $cart = Cart::where('user_id', auth()->user()->id)->with('products')->get();
            $subtotal = 0;
            $tax = 0;
            if ($cart) {
                foreach ($cart as $cartItem) {
                    $productPrice = $cartItem->price;
                    foreach ($cartItem->products as $product) {
                        $taxValue = $product->tax_value;
                        $taxType = $product->tax_type;

                        if ($taxType === 'exclusive') {
                            $subtotal += round($productPrice, 2);
                            $tax += round($productPrice * ($taxValue / 100), 2);
                        } else {
                            $inclusiveTaxFactor = $taxValue / (100 + $taxValue);
                            $subtotal += round($productPrice - ($productPrice * $inclusiveTaxFactor), 2);
                            $tax += round($productPrice * $inclusiveTaxFactor, 2);
                        }
                    }
                }
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

        $total = $subtotal + $tax;

        $price = round($subtotal, 2);
        $tax_value = round($tax, 2);
        $finalprice = round($total, 2);

        return view('checkout', compact('isLoggedIn', 'cart', 'price', 'tax_value', 'finalprice', 'telcode'));
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

                $subtotal = 0;
                $tax = 0;

                foreach ($cart as $cartItem) {
                    $productPrice = $cartItem->price;
                    foreach ($cartItem->products as $product) {
                        $taxValue = $product->tax_value;
                        $taxType = $product->tax_type;

                        if ($taxType === 'exclusive') {
                            $subtotal += round($productPrice, 2);
                            $tax += round($productPrice * ($taxValue / 100), 2);
                        } else {
                            $inclusiveTaxFactor = $taxValue / (100 + $taxValue);
                            $subtotal += round($productPrice - ($productPrice * $inclusiveTaxFactor), 2);
                            $tax += round($productPrice * $inclusiveTaxFactor, 2);
                        }
                    }
                }
                $currency_code = $cart[0]->currency_code;
                $total = $subtotal + $tax;
                $finalprice = round($total, 2);

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
                    'total' => $finalprice,
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

            $subtotal = 0;
            $tax = 0;

            if ($cart) {
                foreach ($cart as $cartItem) {
                    $productPrice = $cartItem->price;
                    foreach ($cartItem->products as $product) {
                        $taxValue = $product->tax_value;
                        $taxType = $product->tax_type;

                        if ($taxType === 'exclusive') {
                            $subtotal += round($productPrice, 2);
                            $tax += round($productPrice * ($taxValue / 100), 2);
                        } else {
                            $inclusiveTaxFactor = $taxValue / (100 + $taxValue);
                            $subtotal += round($productPrice - ($productPrice * $inclusiveTaxFactor), 2);
                            $tax += round($productPrice * $inclusiveTaxFactor, 2);
                        }
                    }
                }
            }
            $currency_code = $cart[0]->currency_code;

            $total = $subtotal + $tax;
            $finalprice = round($total, 2);

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
                'total' => $finalprice,
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
