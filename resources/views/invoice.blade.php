{{--
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice</title>
    <style type="text/css">
        * {
            font-family: "DejaVu Sans Mono", monospace;
        }
    </style>
</head>

<body>
    <div
        style="max-width: 800px;margin: auto;padding: 16px;border: 1px solid #eee;font-size: 16px;line-height: 24px;font-family: 'Inter', sans-serif;color: #555;background-color: #F9FAFC;">
        <table style="font-size: 12px; line-height: 20px;">
            <thead>
                <tr>
                    <td style="padding: 0 16px 18px 16px;">
                        <h1
                            style="color: #1A1C21;font-size: 18px;font-style: normal;font-weight: 600;line-height: normal;">
                            Arihant E-Commerce Services Pvt. Ltd. </h1>
                        <p>arihantj916@gmail.com</p>
                        <p>+91 9672670732</p>
                    </td>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>
                        <table
                            style="background-color: #FFF; padding: 20px 16px; border: 1px solid #D7DAE0;width: 100%; border-radius: 12px;font-size: 12px; line-height: 20px; table-layout: fixed;">
                            <tbody>
                                <tr>
                                    <td
                                        style="vertical-align: top; width: 30%; padding-right: 20px;padding-bottom: 35px;">
                                        <p style="font-weight: 700; color: #1A1C21;">Client Name</p>
                                        <p style="color: #5E6470;">{{Str::ucfirst($order->user->name)}}</p>
                                        <p style="font-weight: 700; color: #1A1C21;">Client Email</p>
                                        <p style="color: #5E6470;">{{$order->user->email}}</p>
                                    </td>
                                    <td
                                        style="vertical-align: top; width: 35%; padding-right: 20px;padding-bottom: 35px;">
                                        <p style="font-weight: 700; color: #1A1C21;">Delivery Location</p>
                                        <p style="color: #5E6470;">
                                            {{$order->address->address}},{{$order->address->city}},{{$order->address->state}},{{$order->address->country}},
                                            {{$order->address->pincode}}
                                        </p>
                                    </td>

                                </tr>
                                <tr>
                                    <td style="padding-bottom: 13px;">
                                        <p style="color: #5E6470;">Service </p>
                                        <p style="font-weight: 700; color: #1A1C21;">Delivery Service</p>
                                    </td>
                                    <td style="text-align: center; padding-bottom: 13px;">
                                        <p style="color: #5E6470;">Invoice number</p>
                                        <p style="font-weight: 700; color: #1A1C21;">#{{$order->id}}</p>
                                    </td>
                                    <td style="text-align: end; padding-bottom: 13px;">
                                        <p style="color: #5E6470;">Invoice date</p>
                                        <p style="font-weight: 700; color: #1A1C21;">{{now()}}</p>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="3">
                                        <table style="width: 100%;border-spacing: 0;">
                                            <thead>
                                                <tr style="text-transform: uppercase;">
                                                    <td style="padding: 8px 0; border-block:1px solid #D7DAE0;">Item
                                                        Detail</td>
                                                    <td
                                                        style="padding: 8px 0; border-block:1px solid #D7DAE0; width: 40px;">
                                                        Qty
                                                    </td>
                                                    <td
                                                        style="padding: 8px 0; border-block:1px solid #D7DAE0; text-align: end; width: 100px;">
                                                        Rate</td>
                                                    <td
                                                        style="padding: 8px 0; border-block:1px solid #D7DAE0; text-align: end; width: 120px;">
                                                        Amount</td>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($order->products as $product)
                                                <tr>
                                                    <td style="padding-block: 12px;">
                                                        <p style="font-weight: 700; color: #1A1C21;">
                                                            {{Str::ucfirst($product->product->name)}}
                                                        </p>
                                                    </td>
                                                    <td style="padding-block: 12px;">
                                                        <p style="font-weight: 700; color: #1A1C21;">
                                                            {{$product->quantity}}
                                                        </p>
                                                    </td>
                                                    <td style="padding-block: 12px; text-align: end;">
                                                        <p style="font-weight: 700; color: #1A1C21;">
                                                            ₹{{$product->price / $product->quantity}}</p>
                                                    </td>
                                                    <td style="padding-block: 12px; text-align: end;">
                                                        <p style="font-weight: 700; color: #1A1C21;">
                                                            ₹{{$product->price}}</p>
                                                    </td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <td style="padding: 12px 0; border-top:1px solid #D7DAE0;"></td>
                                                    <td style="border-top:1px solid #D7DAE0;" colspan="3">
                                                        <table style="width: 100%;border-spacing: 0;">
                                                            <tbody>
                                                                <tr>
                                                                    <th
                                                                        style="padding-top: 12px;text-align: start; color: #1A1C21;">
                                                                        Subtotal</th>
                                                                    <td
                                                                        style="padding-top: 12px;text-align: end; color: #1A1C21;">
                                                                        ₹{{$order->total_price}}</td>
                                                                </tr>
                                                                <tr>
                                                                    <th
                                                                        style="padding: 12px 0;text-align: start; color: #1A1C21;">
                                                                        GST (12%)</th>
                                                                    <td
                                                                        style="padding: 12px 0;text-align: end; color: #1A1C21;">
                                                                        ₹{{$order->total_price * 0.12}}</td>
                                                                </tr>
                                                            </tbody>
                                                            <tfoot>
                                                                <tr>
                                                                    <th
                                                                        style="padding: 12px 0 30px 0;text-align: start; color: #1A1C21;border-top:1px solid #D7DAE0;">
                                                                        Total Price</th>
                                                                    <th
                                                                        style="padding: 12px 0 30px 0;text-align: end; color: #1A1C21;border-top:1px solid #D7DAE0;">
                                                                        ₹{{$order->total_price + $order->total_price *
                                                                        0.12}}
                                                                    </th>
                                                                </tr>
                                                            </tfoot>
                                                        </table>
                                                    </td>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </td>
                </tr>
            </tbody>
            <tfoot>
                <tr>
                    <td style="padding-top: 30px;">
                        <p style="display: flex; gap: 0 13px;"><span style="color: #1A1C21;font-weight: 700;">Arihant
                                E-Commerce Services Pvt. Ltd.</span><span>VidhyaDhar Nagar, Jaipur,
                                Rajasthan</span><span>Registration
                                number:9672670732</span></p>
                        <p style="color: #1A1C21;">Any questions, contact customer service at <a
                                href="mailto:arihantj916@gmail.com" style="color: #000;">arihantj916@gmail.com</a>.
                        </p>
                    </td>
                </tr>
            </tfoot>
        </table>
    </div>
</body>

</html>--}}

@extends('layout.index')


@section("category")

<div class="page-header d-print-none">
    <div class="container-xl">
        <div class="row g-2 align-items-center">
            <div class="col">
                <h2 class="page-title">
                    Invoice
                </h2>
            </div>
            <div class="col-auto ms-auto d-print-none">
                <button type="button" class="btn btn-primary" onclick="javascript:window.print();">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24"
                        stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
                        stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <path d="M17 17h2a2 2 0 0 0 2 -2v-4a2 2 0 0 0 -2 -2h-14a2 2 0 0 0 -2 2v4a2 2 0 0 0 2 2h2" />
                        <path d="M17 9v-4a2 2 0 0 0 -2 -2h-6a2 2 0 0 0 -2 2v4" />
                        <path d="M7 13m0 2a2 2 0 0 1 2 -2h6a2 2 0 0 1 2 2v4a2 2 0 0 1 -2 2h-6a2 2 0 0 1 -2 -2z" />
                    </svg>
                    Print Invoice
                </button>
            </div>
        </div>
    </div>
</div>
<!-- Page body -->
<div class="page-body">
    <div class="container-xl">
        <div class="card card-lg">
            <div class="card-body">
                <div class="row">
                    <div class="col-6">
                        <p class="h3">Arihant E-Commerce Services Pvt. Ltd.</p>
                        <address>
                            VidhyaDhar Nagar<br>
                            Jaipur, Rajasthan<br>
                            302039<br>
                            arihantj916@gmail.com
                        </address>
                    </div>
                    <div class="col-6 text-end">
                        <p class="h3">{{Str::ucfirst($order->user->name)}}</p>
                        <address>
                            {{$order->address->address}}<br>
                            {{$order->address->city}}, {{$order->address->state}}<br>
                            {{$order->address->pincode}}<br>
                            {{$order->user->email}}
                        </address>
                    </div>
                    <div class="col-12 my-5">
                        <h1>Invoice #INV/{{$order->id}}</h1>
                    </div>
                </div>
                <table class="table table-transparent table-responsive">
                    <thead>
                        <tr>
                            <th class="text-center" style="width: 1%"></th>
                            <th>Product</th>
                            <th class="text-center" style="width: 1%">Qnt</th>
                            <th class="text-end" style="width: 1%">Unit</th>
                            <th class="text-end" style="width: 1%">Amount</th>
                        </tr>
                    </thead>
                    @foreach ($order->products as $product)
                                    <tr>
                                        <td class="text-center">{{ $loop->iteration }}</td>
                                        <td>
                                            <p class="strong mb-1">{{Str::ucfirst($product->product->name)}}</p>
                                        </td>
                                        <td class="text-center">
                                            {{$product->quantity}}
                                        </td>
                                        <td class="text-end">₹{{$product->price / $product->quantity}}</td>
                                        <td class="text-end">₹{{$product->price}}</td>
                                    </tr>


                                    <!-- Summary -->
                                    <tr>
                                        <td colspan="4" class="strong text-end">Subtotal</td>
                                        <td class="text-end">₹{{$order->total_price}}</td>
                                    </tr>
                                    <tr>
                                        <td colspan="4" class="strong text-end">GST</td>
                                        <td class="text-end">12%</td>
                                    </tr>
                                    <tr>
                                        <td colspan="4" class="font-weight-bold text-uppercase text-end">Total Due</td>
                                        <td class="font-weight-bold text-end"> ₹{{$order->total_price + $order->total_price *
                        0.12}}</td>
                                    </tr>
                    @endforeach
                </table>
                <p class="text-secondary text-center mt-5">Thank you for your order.</p>
            </div>
        </div>
    </div>
</div>


@endsection