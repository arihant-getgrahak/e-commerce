<?php

namespace App\Http\Controllers;

use App\Imports\ProductImport;
use App\Models\DeliveryCity;
use App\Models\DeliveryCountry;
use App\Models\DeliveryState;
use App\Models\Order;
use App\Models\OrderStatus;
use App\Models\PickupAddress;
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
            ->paginate(5);

        $pickupAddress = PickupAddress::where('user_id', Auth::user()->id)->get();

        return view('admin.order', compact('orders', 'pickupAddress'));
    }

    public function specific($id)
    {
        $order = Order::where('id', $id)->with(['products.product', 'user', 'address'])->get();

        return view('adminorderspecific', compact('order'));
    }

    public function update(Request $request, $id, ShipRocketController $shipRocketController)
    {
        $order = Order::with([
            'products.product',
            'user',
            'address',
        ])->find($id);

        if (! $order) {
            return back()->with('error', 'Order not found.');
        }

        $restrictedStatuses = ['cancelled', 'delivered', 'shipped'];
        if (in_array($order->status, $restrictedStatuses)) {
            return back()->with('error', 'You cannot update '.$order->status.' order.');
        }
        if ($request->status === 'shipped') {
            $shipRocketResponse = $shipRocketController->createOrder($order, $request->pickup);

            if (! $shipRocketResponse || ! method_exists($shipRocketResponse, 'status')) {
                return back()->with('error', 'Failed to create order in ShipRocket.');
            }

            if ($shipRocketResponse->status() === 200) {
                $storeResponse = $shipRocketController->store($shipRocketResponse->json());

                if (! $storeResponse['status']) {
                    return back()->with('error', $storeResponse['message']);
                }
            } else {
                return response()->json(['data' => $shipRocketResponse->json()]);
            }
        }

        if ($order->status !== 'pending') {
            OrderStatus::create([
                'order_id' => $order->id,
                'status' => $order->status,
                'created_at' => now(),
            ]);
        }

        $order->update([
            'status' => $request->status,
        ]);

        return back()->with('success', 'Order updated successfully.');
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

    public function invoice($id)
    {
        $order = Order::with([
            'products.product',
            'user',
            'address',
        ])->find($id);

        return view('invoice', ['order' => $order]);
    }

    public function printNode($id, $printerId)
    {
        $order = Order::with([
            'products.product',
            'user',
            'address',
        ])->find($id);

        $pdf = Pdf::loadView('printinvoice', [
            'order' => $order,
        ]);

        $pdfOutput = $pdf->output();
        $pdfBase64 = base64_encode($pdfOutput);

        $isPrintSuccess = $this->sendToPrintNode($pdfBase64, "Invoice{$order->id}", $printerId);
        if ($isPrintSuccess['success']) {
            return response()->json(['success' => true, 'message' => 'Invoice printed successfully'], 200);
        }

        return response()->json(['success' => false, 'message' => $isPrintSuccess['error']], 400);
    }

    private function sendToPrintNode($pdfBase64, $title, $printerId)
    {
        $apiKey = env('PRINTNODE_AUTH_USERNAME');
        // $printerId = env('PRINTNODE_PRINTER_ID');
        $client = new \GuzzleHttp\Client;

        try {
            $response = $client->post('https://api.printnode.com/printjobs', [
                'auth' => [$apiKey, env('PRINTNODE_AUTH_KEY')],
                'json' => [
                    'printerId' => $printerId,
                    'title' => $title,
                    'contentType' => 'pdf_base64',
                    'content' => $pdfBase64,
                ],
            ]);

            if ($response->getStatusCode() === 201) {
                return ['success' => true];
            }

            return ['success' => false, 'error' => 'Unexpected response from PrintNode'];
        } catch (\Exception $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    public function getPrinters()
    {
        $apiKey = env('PRINTNODE_AUTH_USERNAME');
        $response = Http::withBasicAuth($apiKey, env('PRINTNODE_AUTH_KEY'))
            ->get('https://api.printnode.com/printers');

        if ($response->successful()) {
            return response()->json(['success' => true, 'data' => $response->json()], 200);
        } else {
            return response()->json(['success' => false, 'error' => 'Failed to fetch printers'], $response->status());
        }
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
            ->paginate(5);

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
        $state = DeliveryState::with('country')->paginate(10);
        if (! $state) {
            return back()->with('error', 'State not found');
        }

        return view('admin.address.state', compact('state'));
    }

    public function city()
    {
        $city = DeliveryCity::with('state')->paginate(10);
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

    public function track_order()
    {
        return view('trackorderinput');
    }

    public function updateGlobalCountry(Request $request)
    {
        session()->put('country', $request->name);

        return response()->json(['success' => true], 200);
    }
}
