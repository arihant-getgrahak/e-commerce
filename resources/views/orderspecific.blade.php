@extends('layout.index')

@section("specificOrder")

<main>
    <h1>Order Details #{{ $order->id }}</h1>
    <p class="status">Status: 
        <span class="text-{{ $order->status === 'cancelled' ? 'danger' : 'success' }}">
        {{ $order->status }}
        </span>
    </p>
    <p>Created at: {{ $order->created_at }}</p>
    <p>Total: ₹{{ $order->total }}</p>
    <p>User Details:</p>
    <ul>
        <li>Name: {{ $order->user->name }}</li>
        <li>Email: {{ $order->user->email }}</li>
        <li>City: {{ $order->address->city }}</li>
    </ul>
    <p>Products:</p>
    <ul>
        @foreach ($order->products as $product)
            <li>{{ $product->name }}</li>
            <ul>
                <li>Price: ₹{{ $product->price }}</li>
                <li>Quantity: {{ $product->quantity }}</li>
                <li>SKU: {{ $product->product->sku }}</li>
            </ul>
        @endforeach
    </ul>

</main>

@endsection