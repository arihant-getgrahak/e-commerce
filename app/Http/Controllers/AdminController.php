<?php

namespace App\Http\Controllers;

use App\Imports\ProductImport;
use App\Models\DeliveryCity;
use App\Models\DeliveryCountry;
use App\Models\DeliveryState;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\OrderStatus;
use App\Models\User;
use Auth;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Validator;

class AdminController extends Controller
{
    public function index()
    {
        $orders = Order::with(['products.product', 'user', 'address'])
            ->orderByDesc('created_at')
            ->get();

        return view('adminorder', compact('orders'));
    }

    public function specific($id)
    {
        $order = Order::where('id', $id)->with(['products.product', 'user', 'address'])->get();

        return view('adminorderspecific', compact('order'));
    }

    public function update(Request $request, $id)
    {
        $orderproduct = OrderProduct::find($id);

        if (! $orderproduct) {
            return back()->with('error', 'Product not found.');
        }

        $data = $request->only(['status', 'delivery_date']);

        if ($request->status == 'delivered') {
            $data['delivery_date'] = now();
        }

        if ($orderproduct->status == 'cancelled') {
            return back()->with('error', 'You cannot update cancelled order');
        }

        if ($orderproduct->status == 'delivered') {
            return back()->with('error', 'You cannot update delivered order');
        }

        $orderproduct->update($data);

        $order = Order::with(['products'])->find($orderproduct->order_id);

        $allDelivered = $order->products->every(fn ($product) => $product->status === 'delivered');
        $allCancelled = $order->products->every(fn ($product) => $product->status === 'cancelled');
        $allshipped = $order->products->every(fn ($product) => $product->status === 'shipped');

        if ($allDelivered) {
            $order->status = 'delivered';
        } elseif ($allCancelled) {
            $order->status = 'cancelled';
        } elseif ($allshipped) {
            $order->status = 'shipped';
        } else {
            $order->status = 'pending';
        }

        $order->save();

        OrderStatus::create([
            'order_id' => $order->id,
            'status' => $order->status,
            'created_at' => now(),
        ]);

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
        $order = Order::with([
            'products' => function ($query) {
                $query->where('status', '!=', 'cancelled');
            },
            'products.product',
            'user',
            'address',
        ])
            ->withSum([
                'products as total_price' => function ($query) {
                    $query->where('status', '!=', 'cancelled');
                },
            ], 'price')
            ->find($id);

        $pdf = Pdf::loadView('invoice', ['order' => $order]);

        return $pdf->download('invoice-order-'.$order->id.'.pdf');

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

    public function loginascustomer($id)
    {
        $user = User::find($id);
        Auth::logout();
        Auth::login($user);

        return redirect()->route('my-orders');
    }

    public function track($id)
    {
        $orderstatus = OrderStatus::where('order_id', $id)->with('order')->get();

        return view('ordertrack', compact('orderstatus'));
    }

    public function importCSV(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'file' => 'required|mimes:csv,txt',
        ]);

        // dd($validate);
        if ($validate->fails()) {
            return back()->with('error', $validate->errors()->first());
        }

        Excel::import(new ProductImport, $request->file('file'));

        return redirect()->back()->with('success', 'Products uploaded successfully.');
    }

    public function address()
    {
        $country = DeliveryCountry::all();

        return view('adminaddress', compact('country'));
    }

    public function getState($id)
    {
        $state = DeliveryState::where('country_id', $id)->get();
        if (! $state) {
            return response()->json([]);
        }

        return response()->json($state);
    }

    public function getCity($id)
    {
        $city = DeliveryCity::where('state_id', $id)->get();
        if (! $city) {
            return response()->json([]);
        }

        return response()->json($city);
    }
}
