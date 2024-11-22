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

    public function createOrder($data, $orderproduct)
    {
        try {
            $api = Http::withHeaders([
                'Content-Type' => 'application/json',
                'Authorization' => 'Bearer '.$this->token,
            ])->post('https://apiv2.shiprocket.in/v1/external/orders/create/adhoc', [
                'order_id' => $data->id,
                'order_date' => $data->created_at->format('Y-m-d H:i:s'),
                'pickup_location' => 'home',
                'channel_id' => '5777349',
                'comment' => '',
                'billing_customer_name' => 'Naruto',
                'billing_last_name' => 'Uzumaki',
                'billing_address' => 'House 221B, Leaf Village',
                'billing_address_2' => 'Near Hokage House',
                'billing_city' => 'New Delhi',
                'billing_pincode' => '110002',
                'billing_state' => 'Delhi',
                'billing_country' => 'India',
                'billing_email' => 'naruto@uzumaki.com',
                'billing_phone' => '9876543210',
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
                'order_items' => [
                    [
                        'name' => $orderproduct->product->name,
                        'sku' => $orderproduct->product->sku,
                        'units' => $orderproduct->quantity,
                        'selling_price' => $orderproduct->price,
                        'discount' => '',
                        'tax' => '',
                        'hsn' => 441122,
                    ],
                ],
                'payment_method' => $orderproduct->payment_method == 'cod' ? 'postpaid' : 'prepaid',
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
        $shiprocket = Shipments::create([
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
