<?php

namespace App\Http\Controllers;

use App\Models\PickupAddress;
use App\Models\Shipments;
use Http;

class ShipRocketController extends Controller
{
    protected $id;

    protected $token;

    protected $channelId;

    protected $pickup;

    public function __construct()
    {
        $this->token = env('SHIPROCKET_TOKEN');
        $this->channelId = env('SHIPROCKET_CHANNEL_ID');
    }

    public function createOrder($data, $pickupaddress)
    {
        $this->pickup = PickupAddress::where('tag', $pickupaddress)->first()->id;
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

                $totalLength += (int) $product->product->length;
                $totalBreadth += (int) $product->product->breath;
                $totalHeight += (int) $product->product->height;
                $totalWeight += (int) $product->product->weight;
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
                'billing_customer_name' => $data->address->name,
                'billing_last_name' => '',
                'billing_address' => $data->address->address,
                'billing_address_2' => '',
                'billing_city' => $data->address->city,
                'billing_pincode' => $data->address->pincode,
                'billing_state' => $data->address->state,
                'billing_country' => $data->address->country,
                'billing_email' => $data->address->email,
                'billing_phone' => $data->address->phone,
                'shipping_is_billing' => $data->shipping ? true : false,
                'shipping_customer_name' => $data->shipping->name,
                'shipping_last_name' => '',
                'shipping_address' => $data->shipping->address,
                'shipping_address_2' => '',
                'shipping_city' => $data->shipping->city,
                'shipping_pincode' => $data->shipping->pincode,
                'shipping_country' => $data->shipping->country,
                'shipping_state' => $data->shipping->state,
                'shipping_email' => $data->shipping->email,
                'shipping_phone' => $data->shipping->phone,
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
            return $e->getMessage();
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
            'pickup_address_id' => $this->pickup,
            'actual_weight' => '',
            'volumetric_weight' => '',
            'platform' => $this->channelId,
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
