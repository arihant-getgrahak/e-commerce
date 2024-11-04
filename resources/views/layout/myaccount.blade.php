@extends('layout.frontend')

@section('section')
<section class="middle">
    <div class="container">
        <div class="row align-items-start justify-content-between">
            <div class="col-12 col-md-12 col-lg-4 col-xl-4 text-center miliods">
                <div class="d-block border rounded">
                    <div class="dashboard_author px-2 py-5">
                        <div class="dash_auth_thumb circle p-1 border d-inline-flex mx-auto mb-2">
                            <img src="assets/img/team-1.jpg" class="img-fluid circle" width="100" alt="" />
                        </div>
                        <div class="dash_caption">
                            <h4 class="fs-md ft-medium mb-0 lh-1">{{Str::ucfirst(auth()->user()->name)}}</h4>
                            <span class="text-muted smalls">India</span>
                        </div>
                    </div>

                    <div class="dashboard_author">
                        <h4 class="px-3 py-2 mb-0 lh-2 gray fs-sm ft-medium text-muted text-uppercase text-left">
                            Dashboard Navigation</h4>
                        <ul class="dahs_navbar">
                            <li><a href="my-orders.html" class="active"><i class="lni lni-shopping-basket mr-2"></i>My
                                    Order</a></li>
                            <li><a href="wishlist.html"><i class="lni lni-heart mr-2"></i>Wishlist</a></li>
                            <li><a href="profile-info.html"><i class="lni lni-user mr-2"></i>Profile Info</a></li>
                            <li><a href="addresses.html"><i class="lni lni-map-marker mr-2"></i>Addresses</a></li>
                            <li><a href="payment-methode.html"><i class="lni lni-mastercard mr-2"></i>Payment
                                    Methode</a></li>
                            <li><a href="login.html"><i class="lni lni-power-switch mr-2"></i>Log Out</a></li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="col-12 col-md-12 col-lg-8 col-xl-8 text-center">
                @yield("order-display")
                @yield("wishlist")
            </div>
        </div>
</section>
@endsection