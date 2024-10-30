@extends('layout.frontend')

@section('section')

@if ($cart->isEmpty())
    <p>Your cart is empty.</p>
@else
    <section class="middle">
        <div class="container">

            <div class="row">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                    <div class="text-center d-block mb-5">
                        <h2>Shopping Cart</h2>
                    </div>
                </div>
            </div>

            <div class="row justify-content-between">
                <div class="col-12 col-lg-7 col-md-12">
                    @foreach ($cart as $c)
                        <ul class="list-group list-group-sm list-group-flush-y list-group-flush-x mb-4">
                            <li class="list-group-item">
                                <div class="row align-items-center">
                                    <div class="col-3">
                                        <!-- Image -->
                                        <a href="{{route("product.specific", $c->products[0]->slug)}}"><img
                                                src="{{$c->products[0]->thumbnail}}" alt="{{$c->products[0]->name}}"
                                                class="img-fluid"></a>
                                    </div>
                                    <div class="col d-flex align-items-center justify-content-between">
                                        <div class="cart_single_caption pl-2">
                                            <h4 class="product_title fs-md ft-medium mb-1 lh-1">{{$c->products[0]->name}}</h4>
                                            <!-- <p class="mb-1 lh-1"><span class="text-dark">Size: 40</span></p>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                <p class="mb-3 lh-1"><span class="text-dark">Color: Blue</span></p> -->
                                            <h4 class="fs-md ft-medium mb-3 lh-1">₹{{$c->products[0]->price}}</h4>
                                            <select class="custom-select w-auto mb-2" id="quantity" data-id="{{$c->id}}"
                                                data-price="{{$c->products[0]->price}}">
                                                @for ($i = 1; $i <= 5; $i++)
                                                    <option value="{{ $i }}" {{ $i == $c->quantity ? 'selected' : '' }}>{{ $i }}
                                                    </option>
                                                @endfor
                                            </select>
                                        </div>
                                        <div class="fls_last"><button class="close_slide gray" id="remove-cart"
                                                data-id="{{$c->id}}"><i class="ti-close"></i></button>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    @endforeach

                    <div class="row align-items-end justify-content-between mb-10 mb-md-0">
                        <div class="col-12 col-md-7">
                            <!-- Coupon -->
                            <form class="mb-7 mb-md-0">
                                <label class="fs-sm ft-medium text-dark">Coupon code:</label>
                                <div class="row form-row">
                                    <div class="col">
                                        <input class="form-control" type="text" placeholder="Enter coupon code*">
                                    </div>
                                    <div class="col-auto">
                                        <button class="btn btn-dark" type="submit">Apply</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="col-12 col-md-auto mfliud">
                            <button class="btn stretched-link borders" id="update-cart">Update
                                Cart</button>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-md-12 col-lg-4">
                    <div class="card mb-4 gray mfliud">
                        <div class="card-body">
                            <ul class="list-group list-group-sm list-group-flush-y list-group-flush-x">
                                <li class="list-group-item d-flex text-dark fs-sm ft-regular">
                                    <span>Subtotal</span> <span class="ml-auto text-dark ft-medium">₹{{$price}}</span>
                                </li>
                                <li class="list-group-item d-flex text-dark fs-sm ft-regular">
                                    <span>Tax</span> <span class="ml-auto text-dark ft-medium">₹0</span>
                                </li>
                                <li class="list-group-item d-flex text-dark fs-sm ft-regular">
                                    <span>Total</span> <span class="ml-auto text-dark ft-medium">₹{{$price}}</span>
                                </li>
                                <li class="list-group-item fs-sm text-center">
                                    Shipping cost calculated at Checkout *
                                </li>
                            </ul>
                        </div>
                    </div>

                    <a class="btn btn-block btn-dark mb-3" href="{{route("checkout")}}">Proceed to Checkout</a>

                    <a class="btn-link text-dark ft-medium" href="shop.html">
                        <i class="ti-back-left mr-2"></i> Continue Shopping
                    </a>
                </div>

            </div>

        </div>
    </section>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            let quantity = document.querySelectorAll('#quantity');
            const btn = document.querySelectorAll('#update-cart');

            const updatedData = {}


            quantity.forEach(q => {
                q.addEventListener('change', async function () {
                    const productId = this.getAttribute('data-id');
                    updatedData[productId] = { quantity: this.value };
                });
            });

            btn.forEach(btn => {
                btn.addEventListener('click', async function () {
                    const res = await fetch("{{route('cart.update')}}", {
                        method: "POST",
                        headers: {
                            "Content-Type": "application/json",
                            "X-CSRF-TOKEN": "{{ csrf_token() }}"
                        },
                        body: JSON.stringify(updatedData)
                    });

                    const data = await res.json();
                    if (!data.status) {
                        alert(data.message);
                    }
                    else {
                        alert(data.message);
                        window.location.reload();
                    }
                });
            })
        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const btns = document.querySelectorAll("#remove-cart");

            btns.forEach(button => {
                button.addEventListener('click', async function () {
                    const id = this.getAttribute("data-id"); // Moved inside the event listener

                    const res = await fetch("{{route('cart.delete', ':id')}}".replace(":id", id), {
                        method: "DELETE",
                        headers: {
                            "Content-Type": "application/json",
                            "X-CSRF-TOKEN": "{{ csrf_token() }}"
                        },
                    });

                    const data = await res.json();
                    if (!data.status) {
                        alert(data.message);
                    } else {
                        alert(data.message);
                        window.location.reload();
                    }
                });
            });
        });
    </script>

@endif
@endsection