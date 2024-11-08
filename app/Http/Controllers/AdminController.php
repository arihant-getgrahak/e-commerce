<?php

namespace App\Http\Controllers;

use App\Models\Order;

class AdminController extends Controller
{
    public function index()
    {
        $orders = Order::with(['products.product', 'user', 'address'])->get();

        return view('adminorder', compact('orders'));
    }

    public function specific($id)
    {
        $order = Order::where('id', $id)->with(['products.product', 'user', 'address'])->get();

        return view('adminorderspecific', compact('order'));
    }
}
