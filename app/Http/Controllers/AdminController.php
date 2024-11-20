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
use Http;
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

        // if ($order->status === 'pending') {
        //     // Do not update order status if it is already pending
        //     return back()->with('success', 'Product updated successfully, order status remains pending');
        // }

        $allDelivered = $order->products->every(fn ($product) => $product->status === 'delivered');
        $allCancelled = $order->products->every(fn ($product) => $product->status === 'cancelled');
        $allshipped = $order->products->every(fn ($product) => $product->status === 'shipped');

        if ($allDelivered) {
            $order->status = 'delivered';
        } elseif ($allCancelled) {
            $order->status = 'cancelled';
        } elseif ($allshipped) {
            $order->status = 'shipped';
        }

        $order->save();

        if ($order->status !== 'pending') {
            OrderStatus::create([
                'order_id' => $order->id,
                'status' => $order->status,
                'created_at' => now(),
            ]);
        }

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
        $orderstatus = OrderStatus::where('order_id', $id)->with(['order.address', 'order.products.product'])->get();

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

    public function country()
    {
        $country = DeliveryCountry::all();

        return view('admin.address.country', compact('country'));
    }

    public function state()
    {
        $state = DeliveryState::with('country')->get();
        if (! $state) {
            return back()->with('error', 'State not found');
        }

        return view('admin.address.state', compact('state'));
    }

    public function city()
    {
        $city = DeliveryCity::with('state')->get();
        $country = DeliveryCountry::all();
        if (! $city) {
            return back()->with('error', 'City not found');
        }

        return view('admin.address.city', compact(['city', 'country']));
    }

    public function getState($id)
    {
        $state = DeliveryState::where('country_id', $id)->get();
        if (! $state) {
            return response()->json([]);
        }

        return response()->json($state);
    }

    public function addressUpdate(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'country' => 'required|exists:delivery_countries,id',
            'status' => 'required|in:0,1',
        ]);

        if ($validate->fails()) {
            return back()->with('error', $validate->errors()->first());
        }

        $country = DeliveryCountry::find($request->country);
        if (! $country) {
            return back()->with('error', 'Country not found');
        }
        $country->status = $request->status;
        $country->save();

        return back()->with('success', 'Country Status updated successfully');
    }

    public function stateUpdate(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'state' => 'required|exists:delivery_states,id',
            'status' => 'required|in:0,1',
        ]);

        if ($validate->fails()) {
            return response()->json(['success' => false, 'message' => $validate->errors()->first()], 400);
        }

        $state = DeliveryState::find($request->state);
        if (! $state) {
            return response()->json(['success' => false, 'message' => 'State not found'], 404);
        }
        $state->status = $request->status;
        $state->save();

        return response()->json(['success' => true, 'message' => 'State Status updated successfully'], 200);
    }

    public function cityUpdate(Request $request, $id)
    {

        $validate = Validator::make($request->all(), [
            'status' => 'nullable|in:0,1',
            'name' => 'nullable',
        ]);

        if ($validate->fails()) {
            return back()->with('error', $validate->errors()->first());
        }

        $city = DeliveryCity::find($id);
        if (! $city) {
            return back()->with('error', 'City not found');
        }
        $data = $request->only(['name', 'status']);
        $city->update($data);
        // dd($city);

        return back()->with('success', 'City Status Updated Successfully');
    }

    public function checkAddress(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'pincode' => 'required|numeric|digits:6',
        ]);

        if ($validate->fails()) {
            return back()->with('error', $validate->errors()->first());
        }

        $res = Http::get('https://api.postalpincode.in/pincode/'.$request->pincode);
        $data = $res->json()[0];
        if ($data['Status'] !== 'Success') {
            return back()->with('error', 'Invalid Pincode');
        }
        $state = DeliveryState::where('name', $data['PostOffice'][0]['State'])->first();

        if ($state->status) {
            $city = DeliveryCity::where('name', $data['PostOffice'][0]['District'])->first();
            if (! $city) {
                return back()->with('error', 'Delivery Not Available');
            }
            if ($city->status) {
                return back()->with('success', 'Delivery Available');
            }

            return back()->with('error', 'Delivery Not Available');
        }

        return back()->with('error', 'Delivery Not Available');
    }

    public function addCity(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'name' => 'required',
            'state_id' => 'required|exists:delivery_states,id',
            'country' => 'required|exists:delivery_countries,id',
            'status' => 'required|in:0,1',
        ]);
        if ($validate->fails()) {
            return back()->with('error', $validate->errors()->first());
        }
        $cityExist = DeliveryCity::where('name', $request->name)->first();
        if ($cityExist) {
            return back()->with('error', 'City already exist');
        }
        $city = DeliveryCity::create([
            'name' => $request->name,
            'state_id' => $request->state_id,
            'country_id' => $request->country,
            'status' => $request->status,
        ]);

        if (! $city) {
            return back()->with('error', 'City not found');
        }

        return back()->with('success', 'City added successfully');
    }

    public function deleteCity($id)
    {

        $city = DeliveryCity::find($id);

        if (! $city) {
            return back()->with('error', 'City not found');
        }

        $city->delete();

        return back()->with('success', 'City deleted successfully');
    }

    public function orderspeicific($id)
    {
        $order = Order::with(['products.product', 'user', 'address'])->find($id);
        if (! $order) {
            return back()->with('error', 'Order not found');
        }

        return view('orderspecific', compact('order'));
    }
}
