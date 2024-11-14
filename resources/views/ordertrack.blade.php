@extends("layout.frontend")
@section("css")
<style>
    .root {
        padding: 1rem;
        border-radius: 5px;
        box-shadow: 0 2rem 6rem rgba(0, 0, 0, 0.3);
    }

    figure {
        display: flex;
    }

    figure img {
        width: 8rem;
        height: 8rem;
        border-radius: 15%;
        border: 1.5px solid #f05a00;
        margin-right: 1.5rem;
        padding: 1rem;
    }

    figure figcaption {
        display: flex;
        flex-direction: column;
        justify-content: space-evenly;
    }

    figure figcaption h4 {
        font-size: 1.4rem;
        font-weight: 500;
    }

    figure figcaption h6 {
        font-size: 1rem;
        font-weight: 300;
    }

    figure figcaption h2 {
        font-size: 1.6rem;
        font-weight: 500;
    }

    .order-track {
        margin-top: 2rem;
        padding: 0 1rem;
        border-top: 1px dashed #2c3e50;
        padding-top: 2.5rem;
        display: flex;
        flex-direction: column;
    }

    .order-track-step {
        display: flex;
        height: 7rem;
    }

    .order-track-step:last-child {
        overflow: hidden;
        height: 4rem;
    }

    .order-track-step:last-child .order-track-status span:last-of-type {
        display: none;
    }

    .order-track-status {
        margin-right: 1.5rem;
        position: relative;
    }

    .order-track-status-dot {
        display: block;
        width: 2.2rem;
        height: 2.2rem;
        border-radius: 50%;
        background: #f05a00;
    }

    .order-track-status-line {
        display: block;
        margin: 0 auto;
        width: 2px;
        height: 7rem;
        background: #f05a00;
    }

    .order-track-text-stat {
        font-size: 1.3rem;
        font-weight: 500;
        margin-bottom: 3px;
    }

    .order-track-text-sub {
        font-size: 1rem;
        font-weight: 300;
    }

    .order-track {
        transition: all .3s height 0.3s;
        transform-origin: top center;
    }
</style>
@endsection
@section("section")
<section class="root">
    @if($orderstatus->isEmpty())
        <h1>No Tracking Details Found</h1>
    @else
        <figure>
            <figcaption>
                <h4>Tracking Details</h4>
                <h6>Order Number</h6>
                <h2># {{$orderstatus[0]->order->id}}</h2>
            </figcaption>
        </figure>
        <div>
            <div>
                <h4>Shipping Address</h4>
                <p>{{$orderstatus[0]->order->address->address}},
                    {{$orderstatus[0]->order->address->city}}, {{$orderstatus[0]->order->address->state}},
                    {{$orderstatus[0]->order->address->pincode}}
                </p>
            </div>
        </div>
        <div>
            <h4>Products</h4>
            <div class="d-flex flex-column">
                @foreach ($orderstatus[0]->order->products as $product)
                    <div class="d-flex align-items-center" style="gap:10px;">
                        <img style="width:50px;" src="{{$product->product->thumbnail}}" alt="{{$product->product->name}}">
                        <div class="d-flex flex-column">
                            <p>{{$product->product->name}}</p>
                            <p>Quantity: {{$product->quantity}}</p>
                            <p>Price: ₹{{$product->price}}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        <div class="order-track">
            @foreach ($orderstatus as $status)
                <div class="order-track-step">
                    <div class="order-track-status">
                        <span class="order-track-status-dot"></span>
                        <span class="order-track-status-line"></span>
                    </div>
                    <div class="order-track-text">
                        <p class="order-track-text-stat">
                            @unless($status->status === 'pending')
                                {{ Str::ucfirst($status->status) }}
                            @else
                                Order Created
                            @endunless
                        </p>
                        <span class="order-track-text-sub">{{$status->created_at}}</span>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</section>
@endsection