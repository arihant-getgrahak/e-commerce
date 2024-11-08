<?php

namespace App\Http\Controllers;

use App\Models\Order;

class AdminController extends Controller
{
    public function index()
    {
        $orders = Order::with(['products.product', 'user'])->get();

        return view('adminorder', compact('orders'));
    }
}
