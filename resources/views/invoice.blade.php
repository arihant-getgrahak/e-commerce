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
                <button type="button" class="btn btn-primary" onclick="toggleDropdown()">
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

                <div id="print-dropdown" class="dropdown-menu" style="display: none;">
                    <a class="dropdown-item" href="#" onclick="printInvoice('pdf')">Print as PDF</a>
                    <a class="nav-link dropdown-toggle p-1" href="#navbar-base" data-bs-toggle="dropdown"
                        data-bs-auto-close="outside" role="button" aria-expanded="false">Print
                        using PrintNode
                    </a>
                    <div class="dropdown-menu mt-3">
                        <div class="dropdown-menu-columns">
                            <div class="dropdown-menu-column" id="printnode-dropdown">
                            </div>
                        </div>
                    </div>
                    </p>
                </div>
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
                        <p class="h3">{{$store->name}}</p>
                        <address>
                            {{$store->address}}<br>
                            {{$store->city}}, {{$store->state}}<br>
                            {{$store->pincode}}<br>
                            arihantj916@gmail.com <br>
                            <a href="tel:{{$store->phone}}">{{$store->phone}}</a> <br>
                        </address>
                        GST: {{$store->gst}}
                    </div>


                    <!-- shipping address -->
                    @if($order->shipping_address)
                        <div class="col-3 text-end">
                            <p class="h3">Shipping Address</p>
                            <address>
                                {{Str::ucfirst($order->shipping->name)}}<br>
                                {{$order->shipping->address}}<br>
                                {{$order->shipping->city}}, {{$order->shipping->state}}<br>
                                {{$order->shipping->pincode}}<br>
                                {{$order->user->email}}
                            </address>
                        </div>
                    @endif
                    <!-- billing address -->
                    <div @class([$order->shipping_address ? "col-3" : "col-6", "text-end"])>
                        <p class="h3">Billing Address</p>
                        <address>
                            {{Str::ucfirst($order->user->name)}}<br>
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
                                <p class="strong mb-1">{{Str::ucfirst($product->name)}}</p>
                            </td>
                            <td class="text-center">
                                {{$product->quantity}}
                            </td>
                            <td class="text-end">{{$currencyInfo}}{{$product->price / $product->quantity}}</td>
                            <td class="text-end">{{$currencyInfo}}{{$product->price}}</td>
                        </tr>
                    @endforeach

                    <!-- Summary -->
                    <tr>
                        <td colspan="4" class="strong text-end">Subtotal</td>
                        <td class="text-end">{{$currencyInfo}}{{$price}}</td>
                    </tr>
                    <tr>
                        <td colspan="4" class="strong text-end">GST</td>
                        <td class="text-end">{{$currencyInfo}}{{$tax_value}}</td>
                    </tr>
                    <tr>
                        <td colspan="4" class="font-weight-bold text-uppercase text-end">Total Due</td>
                        <td class="font-weight-bold text-end">{{$currencyInfo}}{{$finalprice}}
                        </td>
                    </tr>
                </table>
                <p class="text-secondary text-center mt-5">Thank you for your order.</p>
            </div>
        </div>
    </div>
</div>

<script>
    function toggleDropdown() {
        const dropdown = document.getElementById("print-dropdown");
        dropdown.style.display = dropdown.style.display === "none" ? "block" : "none";
    }

    async function printInvoice(type, orderId, printerId) {
        if (type === "pdf") {
            window.print();
        } else if (type === "printnode") {

            if (!orderId) alert("Order ID not found");
            if (!printerId) alert("Printer ID not found");

            const url = `{{ route('printNode', [':id', ":printerId"]) }}`
                .replace(':id', orderId)
                .replace(':printerId', printerId);

            const res = await fetch(url, {
                method: "get",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": "{{ csrf_token() }}"
                },
            })
            const data = await res.json();

            if (data.status) {
                alert(data.message);
            }
            else {
                alert(data.message);
            }
        }

        document.getElementById("print-dropdown").style.display = "none";
    }

    document.addEventListener("click", function (event) {
        const dropdown = document.getElementById("print-dropdown");
        const button = event.target.closest(".btn-primary");
        if (!dropdown.contains(event.target) && !button) {
            dropdown.style.display = "none";
        }
    });
</script>

<script>
    document.addEventListener('DOMContentLoaded', async function () {
        const dropdown = document.getElementById("printnode-dropdown");
        const res = await fetch("{{route("getPrinter")}}", {
            method: "GET",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": "{{ csrf_token() }}"
            },
        })

        const data = await res.json();
        dropdown.innerHTML = '';

        const orderId = "{{$order->id}}"

        if (data.success) {
            data.data.forEach(printer => {
                dropdown.innerHTML += `
                    <a class="dropdown-item" href="javascript:void(0)" onclick="printInvoice('printnode', ${orderId},  ${printer.id})">
                        <i class="dropdown-icon fe fe-printer"></i> ${printer.name}
                    </a>`
            })
        }
    });
</script>
@endsection