<?php

namespace App\Http\Controllers;

use App\Models\Shipments;
use Http;

class ShipRocketController extends Controller
{
    protected $id;

    protected $token;

    public function __construct()
    {
        $this->token = env('SHIPROCKET_TOKEN');
    }

    public function createOrder($data)
    {
        try {
            $products = [];
            foreach ($data->products as $product) {
                $products[] = [
                    'name' => $product->product->name,
                    'sku' => $product->product->sku,
                    'units' => $product->quantity,
                    'selling_price' => $product->price,
                    'discount' => '',
                    'tax' => '',
                    'hsn' => 441122,
                ];
            }

            $api = Http::withHeaders([
                'Content-Type' => 'application/json',
                'Authorization' => 'Bearer '.'eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJzdWIiOjU0NDQzNTcsInNvdXJjZSI6InNyLWF1dGgtaW50IiwiZXhwIjoxNzMzMzk2NTcxLCJqdGkiOiJsQndOUXpnS2Z0R0kwSWFmIiwiaWF0IjoxNzMyNTMyNTcxLCJpc3MiOiJodHRwczovL3NyLWF1dGguc2hpcHJvY2tldC5pbi9hdXRob3JpemUvdXNlciIsIm5iZiI6MTczMjUzMjU3MSwiY2lkIjo1MjM4NTM1LCJ0YyI6MzYwLCJ2ZXJib3NlIjpmYWxzZSwidmVuZG9yX2lkIjowLCJ2ZW5kb3JfY29kZSI6IiJ9.nQqBaEET2b7_RCD7MAwsF2yve60ndqCf6cq2enr9DnA',
            ])->post('https://apiv2.shiprocket.in/v1/external/orders/create/adhoc', [
                'order_id' => $data->id,
                'order_date' => $data->created_at->format('Y-m-d H:i:s'),
                'pickup_location' => 'home',
                'channel_id' => '5777349',
                'comment' => '',
                'billing_customer_name' => $data->user->name,
                'billing_last_name' => '',
                'billing_address' => $data->address->address,
                'billing_address_2' => '',
                'billing_city' => $data->address->city,
                'billing_pincode' => $data->address->pincode,
                'billing_state' => $data->address->state,
                'billing_country' => $data->address->country,
                'billing_email' => $data->user->email,
                'billing_phone' => $data->user->phone_number,
                'shipping_is_billing' => true,
                'shipping_customer_name' => '',
                'shipping_last_name' => '',
                'shipping_address' => '',
                'shipping_address_2' => '',
                'shipping_city' => '',
                'shipping_pincode' => '',
                'shipping_country' => '',
                'shipping_state' => '',
                'shipping_email' => '',
                'shipping_phone' => '',
                'order_items' => $products,
                'payment_method' => $data->payment_method == 'cod' ? 'postpaid' : 'prepaid',
                'shipping_charges' => 0,
                'giftwrap_charges' => 0,
                'transaction_charges' => 0,
                'total_discount' => 0,
                'sub_total' => 9000,
                'length' => 10,
                'breadth' => 15,
                'height' => 20,
                'weight' => 2.5,
            ]);

            return $api;

        } catch (\Exception $e) {
            return false;
        }
    }

    public function store($data)
    {
        $shiprocket = Shipments::updateOrCreate([
            'order_id' => $data['order_id'],
            'channel_order_id' => $data['channel_order_id'],
            'shipment_id' => $data['shipment_id'],
            'courier_name' => '',
            'status' => $data['status'],
            'pickup_address_id' => 2,
            'actual_weight' => '',
            'volumetric_weight' => '',
            'platform' => '5777349',
            'charges' => '',
        ]);

        if ($shiprocket) {
            return [
                'status' => true,
                'message' => 'Shipment created successfully',
            ];
        } else {
            return [
                'status' => false,
                'message' => 'Shipment not created',
            ];
        }
    }
}
