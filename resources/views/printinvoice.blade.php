<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
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
                            Arihant E-Commerce Services Pvt. Ltd.</h1>
                        <p>VidhyaDhar Nagar, Jaipur</p>
                        <p>Rajasthan, 302039</p>
                        <a href="mailto:arihantj916@gmail.com" style="color: #000;">arihantj916@gmail.com</a>
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
                                        <p style="font-weight: 700; color: #1A1C21;">{{$order->user->name}}</p>
                                        <p style="color: #5E6470;">{{$order->address->address}},
                                            {{$order->address->city}},
                                            {{$order->address->state}}, {{$order->address->country}} ,
                                            {{$order->address->pincode}}
                                        </p>
                                        <p style="color: #5E6470;">{{$order->user->email}}</p>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="text-align: center; padding-bottom: 13px;">
                                        <p style="color: #5E6470;">Invoice number</p>
                                        <p style="font-weight: 700; color: #1A1C21;">#{{$order->id}}</p>
                                    </td>
                                    <td style="text-align: end; padding-bottom: 13px;">
                                        <p style="color: #5E6470;">Invoice date</p>
                                        <p style="font-weight: 700; color: #1A1C21;">{{$order->created_at}}</p>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="3">
                                        <table style="width: 100%;border-spacing: 0;">
                                            <thead>
                                                <tr style="text-transform: uppercase;">
                                                    <td style="padding: 8px 0; border-block:1px solid #D7DAE0;">Item
                                                        Detail
                                                    </td>
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
                                                            <p style="font-weight: 700; color: #1A1C21;">{{$product->name}}
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
                                                                ₹{{$product->price}}
                                                            </p>
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
                                                                        ₹{{$order->total}}
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <th
                                                                        style="padding: 12px 0;text-align: start; color: #1A1C21;">
                                                                        GST (12%)</th>
                                                                    <td
                                                                        style="padding: 12px 0;text-align: end; color: #1A1C21;">
                                                                        ₹{{$order->total * 0.12}}
                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                            <tfoot>
                                                                <tr>
                                                                    <th
                                                                        style="padding: 12px 0 30px 0;text-align: start; color: #1A1C21;border-top:1px solid #D7DAE0;">
                                                                        Total Price</th>
                                                                    <th
                                                                        style="padding: 12px 0 30px 0;text-align: end; color: #1A1C21;border-top:1px solid #D7DAE0;">
                                                                        ₹{{$order->total + $order->total * 0.12}}
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
                                E-Commerce
                                Services Pvt. Ltd, VidhyaDhar Nagar, Jaipur, Rajasthan, 302039</span>
                            <span>Registration number: 9672670732</span>
                        </p>
                        <p style="color: #1A1C21;">Any questions, contact customer service at <a
                                href="mailto:arihantj916@gmail.com" style="color: #000;">arihantj916@gmail.com</a>.</p>
                    </td>
                </tr>
            </tfoot>
        </table>
    </div>
</body>

</html>