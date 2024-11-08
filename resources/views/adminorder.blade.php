@extends('layout.index')

@section('productadd')
<main>
    <div class="page-wrapper">
        <!-- Page header -->
        <div class="page-header d-print-none">
            <div class="container-xl">
                <div class="row g-2 align-items-center">
                    <div class="col">
                        <h2 class="page-title">
                            Datatables
                        </h2>
                    </div>
                </div>
            </div>
        </div>
        <!-- Page body -->
        <div class="page-body">
            <div class="container-xl">
                <div class="card">
                    <div class="card-body">
                        <div id="table-default" class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th><button class="table-sort" data-sort="sort-id">Order Id</button></th>
                                        <th><button class="table-sort" data-sort="sort-name">Product Name</button></th>
                                        <th><button class="table-sort" data-sort="sort-mehod">Payment Method</button>
                                        </th>
                                        <th><button class="table-sort" data-sort="sort-quantity">Quantity</button></th>
                                        <th><button class="table-sort" data-sort="sort-ptotal">Product Total</button>
                                        </th>
                                        <th><button class="table-sort" data-sort="sort-date">Date</button></th>
                                        <th><button class="table-sort" data-sort="sort-status">Status</button></th>
                                        <th><button class="table-sort" data-sort="sort-ototal">Order Total</button></th>
                                        <th><button class="table-sort" data-sort="sort-ototal">Address</button></th>
                                        <th><button class="table-sort" data-sort="sort-ddate">Expected Delivery
                                                Date</button>
                                        </th>
                                        <th><button class="table-sort" data-sort="sort-type">Buttons</button></th>
                                    </tr>
                                </thead>
                                <tbody class="table-tbody">
                                    @foreach ($orders as $order)
                                        @foreach ($order->products as $product)
                                            <tr>
                                                <td class="sort-name">{{$order->id}}</td>
                                                <td class="sort-city">{{$product->product->name}}</td>
                                                <td class="sort-type">{{Str::upper($order->payment_method)}}</td>
                                                <td class="sort-quantity">{{$product->quantity}}</td>
                                                <td class="sort-score">₹{{$product->price}}</td>
                                                <td class="sort-date" data-date="1628071164">
                                                    {{ \Carbon\Carbon::parse($order->created_at)->format('d F Y') }}
                                                </td>
                                                <td class="sort-quantity"> {{Str::ucfirst($order->status)}}</td>
                                                <td class="sort-progress" data-progress="30">
                                                    ₹{{$order->total}}
                                                </td>
                                                <td class="sort-progress" data-progress="30">
                                                    {{$order->address->city}},{{$order->address->state}}
                                                </td>
                                                <td class="sort-progress" data-progress="30">
                                                    {{ \Carbon\Carbon::parse($order->delivery_date)->format('d F Y') }}
                                                </td>

                                                <td class="sort-type space-y-2">
                                                    <a href="#" class="btn btn-primary btn-sm btn-success">View</a>
                                                    <button class="btn btn-primary btn-update btn-sm" data-bs-toggle="modal"
                                                        data-bs-target="#modal-delete-{$c['id']}}">Delete</button>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <footer class="footer footer-transparent d-print-none">
            <div class="container-xl">
                <div class="row text-center align-items-center flex-row-reverse">
                    <div class="col-lg-auto ms-lg-auto">
                        <ul class="list-inline list-inline-dots mb-0">
                            <li class="list-inline-item"><a href="https://tabler.io/docs" target="_blank"
                                    class="link-secondary" rel="noopener">Documentation</a></li>
                            <li class="list-inline-item"><a href="./license.html" class="link-secondary">License</a>
                            </li>
                            <li class="list-inline-item"><a href="https://github.com/tabler/tabler" target="_blank"
                                    class="link-secondary" rel="noopener">Source code</a></li>
                            <li class="list-inline-item">
                                <a href="https://github.com/sponsors/codecalm" target="_blank" class="link-secondary"
                                    rel="noopener">
                                    <!-- Download SVG icon from http://tabler-icons.io/i/heart -->
                                    <svg xmlns="http://www.w3.org/2000/svg"
                                        class="icon text-pink icon-filled icon-inline" width="24" height="24"
                                        viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                        stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                        <path
                                            d="M19.5 12.572l-7.5 7.428l-7.5 -7.428a5 5 0 1 1 7.5 -6.566a5 5 0 1 1 7.5 6.572" />
                                    </svg>
                                    Sponsor
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="col-12 col-lg-auto mt-3 mt-lg-0">
                        <ul class="list-inline list-inline-dots mb-0">
                            <li class="list-inline-item">
                                Copyright &copy; 2023
                                <a href="." class="link-secondary">Tabler</a>.
                                All rights reserved.
                            </li>
                            <li class="list-inline-item">
                                <a href="./changelog.html" class="link-secondary" rel="noopener">
                                    v1.0.0-beta20
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </footer>
    </div>
</main>
@endsection