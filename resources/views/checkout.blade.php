@extends('layout.frontend')

@section('section')
<section class="middle">
    <div class="container">

        <div class="row">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                <div class="text-center d-block mb-5">
                    <h2>Checkout</h2>
                </div>
            </div>
        </div>

        <div class="row justify-content-between">
            <div class="col-12 col-lg-7 col-md-12">
                <form action="{{route("checkout.store")}}" method="post">
                    @csrf
                    <h5 class="mb-4 ft-medium">Billing Details</h5>
                    <div class="row mb-2">
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                            <div class="form-group">
                                <label id="fname" class="text-dark">First Name *</label>
                                <input type="text" class="form-control" placeholder="First Name" id="fname"
                                    name="fname" />
                            </div>
                        </div>

                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                            <div class="form-group">
                                <label id="lname" class="text-dark">Last Name *</label>
                                <input type="text" class="form-control" placeholder="Last Name" id="lname"
                                    name="lname" />
                            </div>
                        </div>

                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                            <div class="form-group">
                                <label id="email" class="text-dark">Email *</label>
                                <input type="email" class="form-control" placeholder="Email" id="email" name="email" />
                            </div>
                        </div>

                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                            <div class="form-group">
                                <label class="text-dark" id="address1">Address 1 *</label>
                                <input type="text" class="form-control" placeholder="Address 1" id="address1"
                                    name="address1" />
                            </div>
                        </div>

                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                            <div class="form-group">
                                <label class="text-dark" id="address2">Address 2</label>
                                <input type="text" class="form-control" placeholder="Address 2" id="address2"
                                    name="address2" />
                            </div>
                        </div>

                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                            <div class="form-group">
                                <label id="country" class="text-dark">Country *</label>
                                <select class="custom-select" id="country" name="country">
                                    <option value="India" selected="">India</option>
                                    <option value="United State">United State</option>
                                    <option value="United Kingdom">United Kingdom</option>
                                    <option value="China">China</option>
                                    <option value="Germany">Germany</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                            <div class="form-group">
                                <label class="text-dark" id="state">State *</label>
                                <input type="text" class="form-control" placeholder="State" name="state" id="state" />
                            </div>
                        </div>

                        <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12">
                            <div class="form-group">
                                <label class="text-dark" id="city">City / Town *</label>
                                <input type="text" class="form-control" placeholder="City / Town" name="city"
                                    id="city" />
                            </div>
                        </div>

                        <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12">
                            <div class="form-group">
                                <label class="text-dark" id="pincode">ZIP / Postcode *</label>
                                <input type="text" class="form-control" id="pincode" name="pincode"
                                    placeholder="Zip / Postcode" />
                            </div>
                        </div>

                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                            <div class="form-group">
                                <label class="text-dark" id="phone">Mobile Number *</label>
                                <input type="text" class="form-control" placeholder="Mobile Number" name="phone"
                                    id="phone" />
                            </div>
                        </div>

                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                            <div class="form-group">
                                <label class="text-dark">Additional Information</label>
                                <textarea class="form-control ht-50"></textarea>
                            </div>
                        </div>

                    </div>

                    <div class="row mb-4">
                        <div class="col-12 d-block">
                            <input id="createaccount" class="checkbox-custom" name="createaccount" type="checkbox">
                            <label for="createaccount" class="checkbox-custom-label">Create An Account?</label>
                        </div>
                    </div>



                    <h5 class="mb-4 ft-medium">Payments</h5>


                    <div class="row mb-4">
                        <div class="col-12">
                            <div class="panel-group pay_opy980" id="payaccordion">

                                <!-- Cash on Delivery -->
                                <div class="col-12 d-block">
                                    <input id="payment_method_cod" class="select-custom" name="payment_method"
                                        type="radio" value="cod">
                                    <label for="payment_method_cod" class="checkbox-custom-label">Cash on
                                        Delivery</label>
                                </div>

                                <!-- Razorpay -->
                                <div class="col-12 d-block">
                                    <input id="payment_method_razorpay" class="select-custom" name="payment_method"
                                        type="radio" value="razorpay" disabled>
                                    <label for="payment_method_razorpay" class="checkbox-custom-label">Razorpay</label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-block btn-dark">Checkout</button>

                </form>
            </div>

            <!-- Sidebar -->
            <div class="col-12 col-lg-4 col-md-12">
                <div class="d-block mb-3">
                    <h5 class="mb-4">Order Items (3)</h5>
                    <ul class="list-group list-group-sm list-group-flush-y list-group-flush-x mb-4">

                        <li class="list-group-item">
                            <div class="row align-items-center">
                                <div class="col-3">
                                    <!-- Image -->
                                    <a href="product.html"><img src="assets/img/product/7-a.jpg" alt="..."
                                            class="img-fluid"></a>
                                </div>
                                <div class="col d-flex align-items-center">
                                    <div class="cart_single_caption pl-2">
                                        <h4 class="product_title fs-md ft-medium mb-1 lh-1">Women Striped Shirt Dress
                                        </h4>
                                        <p class="mb-1 lh-1"><span class="text-dark">Size: 40</span></p>
                                        <p class="mb-3 lh-1"><span class="text-dark">Color: Blue</span></p>
                                        <h4 class="fs-md ft-medium mb-3 lh-1">$129</h4>
                                    </div>
                                </div>
                            </div>
                        </li>

                        <li class="list-group-item">
                            <div class="row align-items-center">
                                <div class="col-3">
                                    <!-- Image -->
                                    <a href="product.html"><img src="assets/img/product/7.jpg" alt="..."
                                            class="img-fluid"></a>
                                </div>
                                <div class="col d-flex align-items-center">
                                    <div class="cart_single_caption pl-2">
                                        <h4 class="product_title fs-md ft-medium mb-1 lh-1">Girls Solid A-Line Dress
                                        </h4>
                                        <p class="mb-1 lh-1"><span class="text-dark">Size: 36</span></p>
                                        <p class="mb-3 lh-1"><span class="text-dark">Color: Red</span></p>
                                        <h4 class="fs-md ft-medium mb-3 lh-1">$129</h4>
                                    </div>
                                </div>
                            </div>
                        </li>

                    </ul>
                </div>

                <div class="card mb-4 gray">
                    <div class="card-body">
                        <ul class="list-group list-group-sm list-group-flush-y list-group-flush-x">
                            <li class="list-group-item d-flex text-dark fs-sm ft-regular">
                                <span>Subtotal</span> <span class="ml-auto text-dark ft-medium">$98.12</span>
                            </li>
                            <li class="list-group-item d-flex text-dark fs-sm ft-regular">
                                <span>Tax</span> <span class="ml-auto text-dark ft-medium">$10.10</span>
                            </li>
                            <li class="list-group-item d-flex text-dark fs-sm ft-regular">
                                <span>Total</span> <span class="ml-auto text-dark ft-medium">$108.22</span>
                            </li>
                            <li class="list-group-item fs-sm text-center">
                                Shipping cost calculated at Checkout *
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

        </div>

    </div>
</section>

<script>
    if ("{{ session('error') }}") {
        alert("{{ session('error') }}");
    }

    if ("{{ session('success') }}") {
        alert("{{ session('success') }}");
    }
</script>

@endsection