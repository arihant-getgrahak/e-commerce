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
                    <a class="dropdown-item" href="#" onclick="printInvoice('printnode',{{$order->id}}??null)">Print
                        using PrintNode</a>
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
                    @endforeach

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
                        <td class="font-weight-bold text-end"> ₹{{$order->total_price + $order->total_price * 0.12}}
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

    async function printInvoice(type, orderId) {
        if (type === "pdf") {
            window.print();
        } else if (type === "printnode") {
            console.log("Printing as HTML...");
            console.log(orderId);

            if (!orderId) alert("Order ID not found");

            const res = await fetch("{{ route('printNode', ':id') }}".replace(':id', orderId), {
                method: "get",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": "{{ csrf_token() }}"
                },
            })
            const data = await res.json();
            console.log(data);
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
@endsection