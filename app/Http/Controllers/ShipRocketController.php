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
        try {
            $this->pickup = PickupAddress::where('tag', $pickupaddress)->value('id');

            $products = [];
            $totalLength = 0;
            $totalBreadth = 0;
            $totalHeight = 0;
            $totalWeight = 0;

            foreach ($data->products as $product) {
                $products[] = [
                    'name' => $product->name,
                    'sku' => $product->product->sku,
                    'units' => $product->quantity,
                    'selling_price' => $product->price / $product->quantity,
                    'discount' => '',
                    'tax' => '',
                    'hsn' => 441122,
                ];

                $totalLength += (float) $product->product->length;
                $totalBreadth += (float) $product->product->breath;
                $totalHeight += (float) $product->product->height;
                $totalWeight += (float) $product->product->weight;
            }

            $payload = [
                'order_id' => $data->id,
                'order_date' => $data->created_at->format('Y-m-d H:i:s'),
                'pickup_location' => $pickupaddress ?? 'home',
                'channel_id' => $this->channelId,
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
                'shipping_is_billing' => $data->shipping_address ? false : true,
                'shipping_customer_name' => $data->shipping_address->name ?? $data->address->name,
                'shipping_last_name' => '',
                'shipping_address' => $data->shipping_address->address ?? $data->address->address,
                'shipping_address_2' => '',
                'shipping_city' => $data->shipping_address->city ?? $data->address->city,
                'shipping_pincode' => $data->shipping_address->pincode ?? $data->address->pincode,
                'shipping_country' => $data->shipping_address->country ?? $data->address->country,
                'shipping_state' => $data->shipping_address->state ?? $data->address->state,
                'shipping_email' => $data->shipping_address->email ?? $data->address->email,
                'shipping_phone' => $data->shipping_address->phone ?? $data->address->phone,
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
            ];

            $response = Http::withHeaders([
                'Content-Type' => 'application/json',
                'Authorization' => 'Bearer '.$this->token,
            ])->post('https://apiv2.shiprocket.in/v1/external/orders/create/adhoc', $payload);

            return $response;
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
