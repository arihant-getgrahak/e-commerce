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
                                                <td class="sort-quantity">{{Str::ucfirst($product->status)}}</td>
                                                <td class="sort-progress" data-progress="30">
                                                    ₹{{$order->total}}
                                                </td>
                                                <td class="sort-progress" data-progress="30">
                                                    {{$order->address->city}},{{$order->address->state}}
                                                </td>
                                                <td class="sort-progress" data-progress="30">
                                                    {{ \Carbon\Carbon::parse($product->delivery_date)->format('d F Y') }}
                                                </td>

                                                <td class="sort-type space-y-2">
                                                    <a href="#" class="btn btn-primary btn-sm btn-success">View</a>
                                                    <button id="btn-update" class="btn btn-primary btn-update btn-sm"
                                                        data-bs-toggle="modal" data-bs-target="#modal-team"
                                                        data-id="{{ $product->id }}"
                                                        data-status="{{$product->status}}">Update</button>
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
    </div>
    <div class="modal modal-blur fade" id="modal-team" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Update form</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="productForm" class="bg-white p-6 rounded-lg shadow-lg" method="post" action=""
                        enctype="multipart/form-data">
                        @csrf

                        <!-- Status -->

                        <div class="mb-3">
                            <label for="name" class="col-form-label required">Product Status</label>
                            <select class="form-select arihant" id="status" name="status">
                                <option value="pending">Pending</option>
                                <option value="shipped">Shipped</option>
                                <option value="delivered">Delivered</option>
                                <option value="cancelled">Cancelled</option>
                            </select>
                        </div>

                        <div class="mb-4">
                            <label for="name" class="col-form-label required">Delivery date</label>
                            <input type="date" id="delivery_date" name="delivery_date"
                                class="mt-1 block w-full p-2 border border-gray-300 rounded-md"
                                placeholder="Enter delivery date">

                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn me-auto" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary ms-auto">Update Form</button>
                </div>
                </form>
            </div>
        </div>
    </div>
</main>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const updateButtons = document.querySelectorAll('.btn-update');
        const updateForm = document.getElementById("productForm");

        updateButtons.forEach(button => {
            button.addEventListener('click', function () {
                const id = this.getAttribute('data-id');
                const status = this.getAttribute('data-status');


                console.log(id)
                updateForm.action = "{{ route('admin.order.update', ':id') }}".replace(':id', id);

                updateForm.querySelector('#status').value = status;
            });
        });
    });

</script>
@endsection