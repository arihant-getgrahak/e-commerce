<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

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

    public function update(Request $request, $id)
    {
        $order = OrderProduct::find($id);

        $data = $request->only(['status', 'delivery_date']);

        if ($request->status == 'delivered') {
            $data['delivery_date'] = now();
        }

        $order->update($data);

        return back()->with('success', 'Order updated successfully');
    }

    public function search(Request $request)
    {
        $query = Order::query();

        if ($request->search_content === 'order') {
            $query->where('id', $request->search)->with(['products.product', 'user', 'address']);

            return response()->json($query->get());
        }

        if ($request->search_content === 'email') {
            $query->whereHas('user', function ($q) use ($request) {
                $q->where('email', $request->search);
            })->with(['products.product', 'user', 'address']);

            return response()->json($query->get());
        }

        if ($request->search_content === 'phone') {
            $query->whereHas('user', function ($q) use ($request) {
                $q->where('phone_number', $request->search);
            })->with(['products.product', 'user', 'address']);

            return response()->json($query->get());
        }
    }

    public function download($id)
    {
        $order = Order::where('id', $id)->with(['products.product', 'user', 'address'])->get();
        $pdf = Pdf::loadView('invoice', ['order' => $order]);

        return $pdf->download('invoice-order-'.$order[0]->id.'.pdf');
    }

    public function user()
    {
        $user = User::with([
            'order.products.product',
            'order.address',
        ])
            ->whereHas('order')
            ->withCount('order')
            ->withSum('order', 'total')
            ->get();

        return view('adminUser', compact('user'));
    }
}
