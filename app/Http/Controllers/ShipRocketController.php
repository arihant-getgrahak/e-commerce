<?php

namespace App\Http\Controllers;

use App\Models\Shipments;
use Http;

class ShipRocketController extends Controller
{
    protected $id;

    protected $token;

    protected $channelId;

    public function __construct()
    {
        $this->token = env('SHIPROCKET_TOKEN');
        $this->channelId = env('SHIPROCKET_CHANNEL_ID');
    }

    public function createOrder($data, $pickupaddress)
    {
        try {
            $products = [];
            $totalLength = 0;
            $totalBreadth = 0;
            $totalHeight = 0;
            $totalWeight = 0;

            foreach ($data->products as $product) {
                $products[] = [
                    'name' => $product->product->name,
                    'sku' => $product->product->sku,
                    'units' => $product->quantity,
                    'selling_price' => $product->price / $product->quantity,
                    'discount' => '',
                    'tax' => '',
                    'hsn' => 441122,
                ];
            }

            foreach ($data->products as $product) {
                $totalLength += $product->product->length;
                $totalBreadth += $product->product->breath;
                $totalHeight += $product->product->height;
                $totalWeight += $product->product->weight;
            }

            $api = Http::withHeaders([
                'Content-Type' => 'application/json',
                'Authorization' => 'Bearer '.$this->token,
            ])->post('https://apiv2.shiprocket.in/v1/external/orders/create/adhoc', [
                'order_id' => $data->id,
                'order_date' => $data->created_at->format('Y-m-d H:i:s'),
                'pickup_location' => $pickupaddress ?? 'home',
                'channel_id' => $this->channelId,
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
                'sub_total' => $data->total,
                'length' => $totalLength,
                'breadth' => $totalBreadth,
                'height' => $totalHeight,
                'weight' => $totalWeight,
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
