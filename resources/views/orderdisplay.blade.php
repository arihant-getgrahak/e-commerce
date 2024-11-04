@extends("layout.myaccount")
@section("order-display")

<div class="ord_list_wrap border mb-4 mfliud">
    <div class="ord_list_head gray d-flex align-items-center justify-content-between px-3 py-3">
        <div class="olh_flex">
            <p class="m-0 p-0"><span class="text-muted">Order Number</span></p>
            <h6 class="mb-0 ft-medium">#1250004123</h6>
        </div>
        <div class="olh_flex">
            <a href="javascript:void(0);" class="btn btn-sm btn-dark">Track Order</a>
        </div>
    </div>
    <div class="ord_list_body text-left">
        <div class="row align-items-center justify-content-center m-0 py-4">
            <div class="col-xl-5 col-lg-5 col-md-5 col-12">
                <div class="cart_single d-flex align-items-start mfliud-bot">
                    <div class="cart_selected_single_thumb">
                        <a href="#"><img src="assets/img/product/7.jpg" width="75" class="img-fluid rounded" alt=""></a>
                    </div>
                    <div class="cart_single_caption pl-3">
                        <p class="mb-0"><span class="text-muted small">Men's</span></p>
                        <h4 class="product_title fs-sm ft-medium mb-1 lh-1">Printed Straight Kurta</h4>
                        <p class="mb-2"><span class="text-dark medium">Size: 36</span>, <span
                                class="text-dark medium">Color: Red</span></p>
                        <h4 class="fs-sm ft-bold mb-0 lh-1">$129</h4>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-3 col-md-3 col-6">
                <p class="mb-1 p-0"><span class="text-muted">Status</span></p>
                <div class="delv_status"><span class="ft-medium small text-danger bg-light-danger rounded px-3 py-1">On
                        Hold</span></div>
            </div>
            <div class="col-xl-4 col-lg-4 col-md-4 col-6">
                <p class="mb-1 p-0"><span class="text-muted">Expected date by:</span></p>
                <h6 class="mb-0 ft-medium fs-sm">12 November 2021</h6>
            </div>
        </div>

    </div>
    <div class="ord_list_footer d-flex align-items-center justify-content-between br-top px-3">
        <div class="col-xl-3 col-lg-3 col-md-4 olf_flex text-left px-0 py-2 br-right"><a href="javascript:void(0);"
                class="ft-medium fs-sm"><i class="ti-close mr-2"></i>Cancel Order</a></div>
        <div class="col-xl-9 col-lg-9 col-md-8 pr-0 py-2 olf_flex d-flex align-items-center justify-content-between">
            <div class="olf_flex_inner hide_mob">
                <p class="m-0 p-0"><span class="text-muted medium">Paid using debit card ending with 6472</span></p>
            </div>
            <div class="olf_inner_right">
                <h5 class="mb-0 fs-sm ft-bold">Total: $4510</h5>
            </div>
        </div>
    </div>
</div>
</div>

@endsection