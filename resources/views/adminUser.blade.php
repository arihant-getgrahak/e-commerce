@extends('layout.index')

@section('user')
<div class="page-wrapper">
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <h2 class="page-title">
                        All Users
                    </h2>
                </div>
            </div>
        </div>
    </div>
    <div class="page-body">
        <div class="container-xl">
            <div class="card">
                <div class="card-body">
                    <div id="table-default" class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th><button class="table-sort" data-sort="sort-id">User Id</button></th>
                                    <th><button class="table-sort" data-sort="sort-name">User Name</button></th>
                                    <th><button class="table-sort" data-sort="sort-email">User Email</button>
                                    <th><button class="table-sort" data-sort="sort-total-order">Total Order</button>
                                    <th><button class="table-sort" data-sort="sort-total-order-price">Total Order
                                            Price</button>
                                    </th>
                                    <th><button class="table-sort" data-sort="sort-payment">Payments Method</button>
                                    </th>
                                    <th><button class="table-sort" data-sort="sort-address">Address</button>
                                    </th>
                                    <th><button class="table-sort" data-sort="sort-button">Button</button></th>
                                </tr>
                            </thead>
                            <tbody class="table-tbody" id="table-body">
                                @foreach ($user as $users)
                                    <tr>
                                        <td class="sort-id">#{{$users->id}}</td>
                                        <td class="sort-name">{{$users->name}}</td>
                                        <td class="sort-email">{{$users->email}}</td>
                                        <td class="sort-total-order">{{$users->order_count}}</td>
                                        <td class="sort-total-order-price">₹{{$users->order_sum_total}}</td>
                                        <td class="sort-payment">
                                            [
                                            @foreach ($users->order as $method)
                                                {{Str::ucfirst($method->payment_method)}}
                                            @endforeach
                                            ]
                                        </td>
                                        <td class="sort-address">
                                            {{$users->order[0]->address->city}},{{$users->order[0]->address->state}}
                                        </td>

                                        <td class="sort-button space-y-2">
                                            <a href="javascript:void(0);" class="btn btn-primary btn-sm">Login as
                                                Customer</a>
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
@endsection