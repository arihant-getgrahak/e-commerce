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
                                        <th><button class="table-sort" data-sort="sort-name">Total Product
                                                Ordered</button></th>
                                        <th><button class="table-sort" data-sort="sort-quantity">Total Price</button>
                                        </th>
                                        <th><button class="table-sort" data-sort="sort-mehod">Payment Method</button>
                                        </th>
                                        <th><button class="table-sort" data-sort="sort-status">Status</button></th>
                                        <th><button class="table-sort" data-sort="sort-ototal">User Address</button>
                                        </th>
                                        <th><button class="table-sort" data-sort="sort-ddate">User Name</button>
                                        </th>
                                        <th><button class="table-sort" data-sort="sort-ddate">User Email</button>
                                        </th>
                                        <th><button class="table-sort" data-sort="sort-ddate">User Phone Number</button>
                                        </th>
                                        <th><button class="table-sort" data-sort="sort-type">Actions</button></th>
                                    </tr>
                                </thead>
                                <tbody class="table-tbody" id="table-body">
                                    @foreach ($orders as $order)
                                        <tr>
                                            <td class="sort-name">{{$order->id}}</td>
                                            <td class="sort-quantity">{{$order->products->count()}}</td>
                                            <td class="sort-city">₹{{$order->total}}</td>
                                            <td class="sort-type">{{Str::upper($order->payment_method)}}</td>
                                            <td class="sort-progress">
                                                {{Str::ucfirst($order->status)}}
                                            </td>
                                            <td class="sort-progress">
                                                {{$order->address->address}},
                                                {{$order->address->city}},{{$order->address->state}},
                                                {{$order->address->pincode}}
                                            </td>
                                            <td class="sort-progress">
                                                {{$order->user->name }}
                                            </td>
                                            <td class="sort-progress">
                                                {{$order->user->email }}
                                            </td>
                                            <td class="sort-progress">
                                                {{$order->user->phone_number }}
                                            </td>
                                            <td class="sort-type space-y-2">
                                                <a href="{{route("order.specific", $order->id)}}"
                                                    class="btn btn-primary btn-sm btn-success">View</a>
                                                <button id="btn-update" class="btn btn-primary btn-update btn-sm"
                                                    data-bs-toggle="modal" data-bs-target="#modal-team"
                                                    data-id="{{ $order->id }}"
                                                    data-status="{{$order->status}}">Update</button>
                                                @if($order->status !== "cancelled")
                                                    <a href="{{route("invoice", $order->id)}}">Download Invoice</a>
                                                @endif
                                            </td>
                                        </tr>
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
                    <h5 class="modal-title">Update Form</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="productForm" class="bg-white p-4 rounded-lg shadow-lg" method="POST" action="">
                        @csrf

                        <!-- Order Status -->
                        <div class="mb-3">
                            <label for="status" class="col-form-label required">Order Status</label>
                            <select class="form-select" id="status" name="status" required>
                                <option value="pending">Pending</option>
                                <option value="shipped">Shipped</option>
                                <option value="delivered">Delivered</option>
                                <option value="cancelled">Cancelled</option>
                            </select>
                        </div>

                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" form="productForm" class="btn btn-primary" id="btn-update-product">Update
                        Status</button>
                </div>
            </div>
        </div>
    </div>
</main>

@include('layout.pagination', ['paginator' => $orders])

<script>
    const searchInputField = document.getElementById('search_content');
    let searchContent = searchInputField.value;

    searchInputField.addEventListener('input', function () {
        searchContent = this.value;
        console.log("Search Content:", searchContent);
    });

    async function searchInput(value) {
        const tableBody = document.getElementById('table-body');
        tableBody.innerHTML = "";

        try {
            const res = await fetch("{{ route('admin.search') }}", {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': "{{ csrf_token() }}"
                },
                body: JSON.stringify({ search: value, search_content: searchContent })
            });

            if (!res.ok) throw new Error("Failed to fetch data");

            const data = await res.json();

            data.forEach(order => {
                const row = generateOrderRow(order);
                tableBody.insertAdjacentHTML('beforeend', row);
            });
        } catch (error) {
            console.error("Error fetching search results:", error);
        }
    }

    function generateOrderRow(order) {
        const status = order.status;
        let data;
        if (status !== "cancelled") {
            data = `<a href="/invoice/${order.id}">Download Invoice</a>`
        }
        return `
            <tr>
                <td>${order.id}</td>
                <td>${order.products.length}</td>
                <td>₹${order.total}</td>
                <td>${order.payment_method.toUpperCase()}</td>
                <td>${order.status.toUpperCase()}</td>
                <td>${order.address.address}, 
                 ${order.address.city},
                 ${order.address.state}, 
                 ${order.address.pincode}</td>
                <td>${order.user.name}</td>
                <td>${order.user.email}</td>
                <td>${order.user.phone_number}</td>
                <td class="sort-type space-y-2">
                    <a href="/admin/order/${order.id}" class="btn btn-primary btn-sm btn-success">View</a>
                    <button class="btn btn-primary btn-sm btn-update" 
                        data-bs-toggle="modal" data-bs-target="#modal-team" 
                        data-id=${order.id} data-status=${order.status}>Update</button>
                    ${data ?? ""}
                </td>
            </tr>`;
    }
</script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const updateForm = document.getElementById("productForm");

        document.body.addEventListener('click', function (event) {
            if (event.target.classList.contains('btn-update')) {
                const button = event.target;
                const id = button.getAttribute('data-id');
                const status = button.getAttribute('data-status');

                updateForm.action = "{{ route('admin.order.update', ':id') }}".replace(':id', id);

                updateForm.querySelector('#status').value = status;
            }
        });
    });
</script>


<script>
    if ("{{session("error")}}") {
        alert("{{session("error")}}");
    }

    if ("{{session("success")}}") {
        alert("{{session("success")}}");
    }
</script>
@endsection