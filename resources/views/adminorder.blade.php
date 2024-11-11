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
                <div class="mt-3">
                    <label for="name" class="col-form-label">Search Order</label>
                    <select class="form-select arihant" id="search_content" name="search_content">
                        <option value="order">OrderId</option>
                        <option value="email">Email</option>
                        <option value="phone">Phone Number</option>
                    </select>

                    <input type="text" id="search" name="search"
                        class="mt-1 w-full block p-2 border border-gray-300 rounded-md" placeholder="Enter search data"
                        onchange="searchInput(this.value)"></table>
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
                                        <th><button class="table-sort" data-sort="sort-ddate">User Email</button>
                                        </th>
                                        <th><button class="table-sort" data-sort="sort-type">Buttons</button></th>
                                    </tr>
                                </thead>
                                <tbody class="table-tbody" id="table-body">
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
                                                    {{\Carbon\Carbon::parse($product->delivery_date)->format('d F Y') }}
                                                </td>

                                                <td class="sort-progress" data-progress="30">
                                                    {{$order->user->email }}
                                                </td>

                                                <td class="sort-type space-y-2">
                                                    <a href="#" class="btn btn-primary btn-sm btn-success"
                                                        data-bs-toggle="modal" data-bs-target="#modal-scrollable" id="btn-view"
                                                        data-id="{{ $order->id }}"
                                                        data-product-name="{{$product->product->name}}"
                                                        data-product-thumbnail="{{$product->product->thumbnail}}"
                                                        data-product-quantity="{{$product->quantity}}"
                                                        data-product-price="{{$product->price}}"
                                                        data-product-ddate="{{\Carbon\Carbon::parse($product->delivery_date)->format('d F Y') }}"
                                                        data-user-email="{{$order->user->email}}"
                                                        data-user-address="{{$order->address->city}},{{$order->address->state}}"
                                                        data-product-status="{{$product->status}}">View</a>
                                                    <button id="btn-update" class="btn btn-primary btn-update btn-sm"
                                                        data-bs-toggle="modal" data-bs-target="#modal-team"
                                                        data-id="{{ $product->id }}"
                                                        data-status="{{$product->status}}">Update</button>
                                                    <a href="{{route("invoice")}}">Download Invoice</a>
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

    <!-- modal -->

    <div class="modal modal-blur fade" id="modal-scrollable" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Order Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p id="order-id"></p>
                    <p id="product-name"></p>
                    <p id="product-quantity"></p>
                    <p id="product-price"></p>
                    <p id="order-status"></p>
                    <p id="product-ddate"></p>
                    <p id="user-email"></p>
                    <p id="user-address"></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn me-auto" data-bs-dismiss="modal">Close</button>
                </div>
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

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const updateForm = document.getElementById("productForm");

        document.getElementById('table-body').addEventListener('click', function (event) {
            if (event.target.classList.contains('btn-update')) {
                const button = event.target;
                const id = button.getAttribute('data-id');
                const status = button.getAttribute('data-status');

                updateForm.action = "{{ route('admin.order.update', ':id') }}".replace(':id', id);
                updateForm.querySelector('#status').value = status;
            }
        });
    });

    document.getElementById('search_content').addEventListener('change', function () {
        searchContent = this.value;
    });

    async function searchInput(value) {
        const tableBody = document.getElementById('table-body');
        tableBody.innerHTML = "";

        const res = await fetch("{{ route('admin.search') }}", {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': "{{ csrf_token() }}"
            },
            body: JSON.stringify({ search: value, search_content: searchContent })
        });

        const data = await res.json();

        data.forEach(order => {
            order.products.forEach(product => {
                const row = generateOrderRow(order, product);
                tableBody.insertAdjacentHTML('beforeend', row);
            });
        });
    }

    function generateOrderRow(order, product) {
        return `
            <tr>
                <td>${order.id}</td>
                <td>${product.product.name}</td>
                <td>${order.payment_method.toUpperCase()}</td>
                <td>${product.quantity}</td>
                <td>₹${product.price}</td>
                <td>${new Date(order.created_at).toLocaleDateString('en-GB', { day: 'numeric', month: 'long', year: 'numeric' })}</td>
                <td>${product.status.toUpperCase()}</td>
                <td>₹${order.total}</td>
                <td>${order.address.city}, ${order.address.state}</td>
                <td>
                {{\Carbon\Carbon::parse($product->delivery_date)->format('d F Y') }}
                </td>
                <td>${order.user.email}</td>
               <td class="sort-type space-y-2">
                    <a href="#" class="btn btn-primary btn-sm btn-success">View</a>
                    <button class="btn btn-primary btn-sm btn-update" data-bs-toggle="modal" data-bs-target="#modal-team" data-id="${product.id}" data-status="${product.status}">Update</button>
                </td>
            </tr>`;
    }
</script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const orderId = document.getElementById("order-id");
        const productName = document.getElementById("product-name");
        const productQuantity = document.getElementById("product-quantity");
        const productPrice = document.getElementById("product-price");
        const productDdate = document.getElementById("product-ddate");
        const userEmail = document.getElementById("user-email");
        const userAddress = document.getElementById("user-address");
        const orderStatus = document.getElementById("order-status");
        const viewBtn = document.querySelectorAll("#btn-view")

        viewBtn.forEach(button => {
            button.addEventListener('click', function () {
                const id = this.getAttribute('data-id');
                const name = this.getAttribute('data-product-name');
                const productThumbnail = this.getAttribute('data-product-thumbnail');
                const quantity = this.getAttribute('data-product-quantity');
                const price = this.getAttribute('data-product-price');
                const ddate = this.getAttribute('data-product-ddate');
                const email = this.getAttribute('data-user-email');
                const address = this.getAttribute('data-user-address');
                const status = this.getAttribute('data-product-status');

                orderId.innerText = "Order Id: " + id
                productName.innerText = "Product Name: " + name
                productQuantity.innerText = "Product Quantity: " + quantity
                productPrice.innerText = "Product Price: " + price
                orderStatus.innerText = "Product Delivery Status: " + status.toUpperCase()
                productDdate.innerText = "Product Delivery Date: " + ddate
                userEmail.innerText = "User Email: " + email
                userAddress.innerText = "User Address: " + address
            })


        });
    });
</script>
@endsection