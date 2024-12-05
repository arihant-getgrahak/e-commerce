@extends("layout.myaccount")

@section("breadcrumb")
<div class="gray py-3">
    <div class="container">
        <div class="row">
            <div class="colxl-12 col-lg-12 col-md-12">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/">{{__("Home")}}</a></li>
                    <li class="breadcrumb-item"><a href="javascript:void(0);">{{__("Dashboard")}}</a></li>
                        <li class="breadcrumb-item"><a href="#">{{__("Orders")}}</a>
                        </li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>
@endsection
@section("order-display")

@if(empty($orders))
    <h1>{{__("No orders found")}}</h1>
@else
    @foreach ($orders as $order)
        <div class="ord_list_wrap border mb-4 mfliud">
            <div class="ord_list_head gray d-flex align-items-center justify-content-between px-3 py-3">
                <div class="olh_flex">
                    <p class="m-0 p-0"><span class="text-muted">{{__("Order Number")}}</span></p>
                    <h6 class="mb-0 ft-medium">#{{ $order->id }}</h6>
                </div>
                <div class="olh_flex">
                    <a href="{{route("order.track", $order->id)}}" class="btn btn-sm btn-dark">{{__("Track Order")}}</a>
                </div>
            </div>

            @foreach ($order->products as $orderProduct)
                <div class="ord_list_body text-left">
                    <div class="row align-items-center justify-content-center m-0 py-4">
                        <div class="col-xl-5 col-lg-5 col-md-5 col-12">
                            <div class="cart_single d-flex align-items-start mfliud-bot">
                                <div class="cart_selected_single_thumb">
                                    <a href="#"><img src="{{ $orderProduct->product->thumbnail }}" width="75"
                                            class="img-fluid rounded" alt={{ $orderProduct->name }}></a>
                                </div>
                                <div class="cart_single_caption pl-3">
                                    <p class="mb-0"><span class="text-muted small">
                                            {{ $orderProduct->product->category->name }}</span></p>
                                    <h4 class="product_title fs-sm ft-medium mb-1 lh-1">{{ $orderProduct->name }}</h4>
                                    <p class="mb-2"><span class="text-dark medium">SKU: {{ $orderProduct->product->sku }}</span>,
                                        <span class="text-dark medium">Weight: {{ $orderProduct->product->weight }}g</span>
                                    </p>
                                    <h4 class="fs-sm ft-bold mb-0 lh-1">₹{{ $orderProduct->price }}</h4>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-lg-3 col-md-3 col-6">
                            <p class="mb-1 p-0"><span class="text-muted">{{__("Status")}}</span></p>
                            <div class="delv_status">
                                <span
                                    class="ft-medium small rounded px-3 py-1 
                                                                                                        {{ $order->status === 'cancelled' ? 'text-danger bg-light-danger' : '' }}
                                                                                                                        {{ $order->status === 'delivered' ? 'text-success bg-light-success' : '' }}
                                                                                                                        {{ $order->status === 'shipped' ? 'text-warning bg-light-warning' : '' }}
                                                                                                                        {{ $order->status === 'pending' ? 'text-info bg-light-info' : '' }}">
                                    {{ Str::ucfirst($order->status) }}
                                </span>
                            </div>
                        </div>

                        <div class="col-xl-4 col-lg-4 col-md-4 col-6">
                            <p class="mb-1 p-0"><span class="text-muted">{{__("Expected date by")}}:</span></p>
                            <h6 class="mb-0 ft-medium fs-sm">
                                {{ \Carbon\Carbon::parse($orderProduct->created_at->addDays(14))->format('d F Y')}}
                            </h6>
                            </h6>
                        </div>
                    </div>
                </div>

            @endforeach



            <div class="ord_list_footer d-flex align-items-center justify-content-between br-top px-3">
                <div class="col-xl-3 col-lg-3 col-md-4 olf_flex text-left px-0 py-2 br-right"><a href="javascript:void(0);"
                        class="ft-medium fs-sm"><i class="ti-close mr-2"></i>{{__("Cancel Order")}}</a></div>
                <div class="col-xl-9 col-lg-9 col-md-8 pr-0 py-2 olf_flex d-flex align-items-center justify-content-between">
                    <div class="olf_flex_inner hide_mob">
                        <p class="m-0 p-0"><span class="text-muted medium">Paid
                                using {{ Str::upper($order->payment_method) }}</span></p>
                    </div>
                    <div class="olf_inner_right">
                        <h5 class="mb-0 fs-sm ft-bold">Total: ₹{{ $order->total }}</h5>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@endif

@endsection