@extends('layout.frontend')
@section("section")
<div id="alert">

</div>
<section class="bg-cover" style="background:url(assets/img/banner-2.png) no-repeat;">
    <div class="container">
        <div class="row align-items-center justify-content-center">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                <div class="text-left py-5 mt-3 mb-3">
                    <h1 class="ft-medium mb-3">Shop</h1>
                    <ul class="shop_categories_list m-0 p-0">
                        @foreach ($categories as $key => $category)
                            <li><a href="#">{{$category["name"]}}</a></li>
                        @endforeach

                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- ======================= Shop Style 1 ======================== -->


<!-- ======================= Filter Wrap Style 1 ======================== -->
<section class="py-3 br-bottom br-top">
    <div class="container">
        <div class="row align-items-center justify-content-between">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item"><a href="#">Shop</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Women's</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</section>
<!-- ============================= Filter Wrap ============================== -->


<!-- ======================= All Product List ======================== -->
<section class="middle">
    <div class="container">
        <div class="row">
            <div class="col-xl-3 col-lg-4 col-md-12 col-sm-12 p-xl-0">
                <div class="search-sidebar sm-sidebar border">
                    <div class="search-sidebar-body">

                        <!-- Single Option -->
                        <div class="single_search_boxed">
                            <div class="widget-boxed-header px-3">
                                <h4 class="mt-3">Categories</h4>
                            </div>
                            <div class="widget-boxed-body">
                                <div class="side-list no-border">
                                    <div class="filter-card" id="shop-categories">
                                        @foreach ($categories as $key => $category)
                                            <div class="single_filter_card">
                                                <h5>
                                                    <a href="#category-{{ $key }}" data-toggle="collapse" class="collapsed"
                                                        aria-expanded="false" role="button">
                                                        {{ $category["name"] }}
                                                        <i class="accordion-indicator ti-angle-down"></i>
                                                    </a>
                                                </h5>

                                                <div class="collapse" id="category-{{ $key }}"
                                                    data-parent="#shop-categories">
                                                    <div class="card-body">
                                                        <div class="inner_widget_link">
                                                            <ul>
                                                                @foreach ($category["child"] as $childCategory)
                                                                    <li><a href="#"
                                                                            data-id="{{ $childCategory->id }}">{{ $childCategory->name }}<span>{{ $childCategory->products_count }}</span></a>
                                                                    </li>
                                                                @endforeach
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Single Option -->
                        <div class="single_search_boxed">
                            <div class="widget-boxed-header">
                                <h4><a href="#pricing" data-toggle="collapse" aria-expanded="false"
                                        role="button">Pricing</a></h4>
                            </div>
                            <div class="widget-boxed-body collapse show" id="pricing" data-parent="#pricing">
                                <div class="side-list no-border mb-4">
                                    <div class="rg-slider">
                                        <input type="text" class="js-range-slider" name="my_range" value=""
                                            id="my_range" onchange="updateTextInput(this.value)" />
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Single Option -->
                        <div class="single_search_boxed">
                            <div class="widget-boxed-header">
                                <h4><a href="#size" data-toggle="collapse" class="collapsed" aria-expanded="false"
                                        role="button">Size</a></h4>
                            </div>
                            <div class="widget-boxed-body collapse" id="size" data-parent="#size">
                                <div class="side-list no-border">
                                    <!-- Single Filter Card -->
                                    <div class="single_filter_card">
                                        <div class="card-body pt-0">
                                            <div class="text-left pb-0 pt-2">
                                                <div class="form-check form-option form-check-inline mb-2">
                                                    <input class="form-check-input" type="radio" name="sizes" id="26s">
                                                    <label class="form-option-label" for="26s">26</label>
                                                </div>
                                                <div class="form-check form-option form-check-inline mb-2">
                                                    <input class="form-check-input" type="radio" name="sizes" id="28s">
                                                    <label class="form-option-label" for="28s">28</label>
                                                </div>
                                                <div class="form-check form-option form-check-inline mb-2">
                                                    <input class="form-check-input" type="radio" name="sizes" id="30s"
                                                        checked>
                                                    <label class="form-option-label" for="30s">30</label>
                                                </div>
                                                <div class="form-check form-option form-check-inline mb-2">
                                                    <input class="form-check-input" type="radio" name="sizes" id="32s">
                                                    <label class="form-option-label" for="32s">32</label>
                                                </div>
                                                <div class="form-check form-option form-check-inline mb-2">
                                                    <input class="form-check-input" type="radio" name="sizes" id="34s">
                                                    <label class="form-option-label" for="34s">34</label>
                                                </div>
                                                <div class="form-check form-option form-check-inline mb-2">
                                                    <input class="form-check-input" type="radio" name="sizes" id="36s">
                                                    <label class="form-option-label" for="36s">36</label>
                                                </div>
                                                <div class="form-check form-option form-check-inline mb-2">
                                                    <input class="form-check-input" type="radio" name="sizes" id="38s">
                                                    <label class="form-option-label" for="38s">38</label>
                                                </div>
                                                <div class="form-check form-option form-check-inline mb-2">
                                                    <input class="form-check-input" type="radio" name="sizes" id="40s">
                                                    <label class="form-option-label" for="40s">40</label>
                                                </div>
                                                <div class="form-check form-option form-check-inline mb-2">
                                                    <input class="form-check-input" type="radio" name="sizes" id="42s">
                                                    <label class="form-option-label" for="42s">42</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Single Option -->
                        <div class="single_search_boxed">
                            <div class="widget-boxed-header">
                                <h4>
                                    <a href="#brands" data-toggle="collapse" aria-expanded="false"
                                        role="button">Brands</a>
                                </h4>
                            </div>
                            <div class="widget-boxed-body collapse show" id="brands" data-parent="#brands">
                                <div class="side-list no-border">
                                    <!-- Single Filter Card -->
                                    <div class="single_filter_card">
                                        <div class="card-body pt-0">
                                            <div class="inner_widget_link" id="brand-list">
                                                <ul class="no-ul-list">
                                                    @foreach ($brand as $b)
                                                        <li>
                                                            <input id="brand-{{ $b->id }}" class="checkbox-custom"
                                                                name="brands[]" type="checkbox" value="{{ $b->id }}"
                                                                data-brand-id="{{ $b->id }}">
                                                            <label for="brand-{{ $b->id }}" class="checkbox-custom-label">
                                                                {{ $b->name }}
                                                                <span>({{ $b->products_count }})</span>
                                                            </label>
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <!-- Single Option -->
                        <div class="single_search_boxed">
                            <div class="widget-boxed-header">
                                <h4><a href="#gender" data-toggle="collapse" class="collapsed" aria-expanded="false"
                                        role="button">Gender</a></h4>
                            </div>
                            <div class="widget-boxed-body collapse" id="gender" data-parent="#gender">
                                <div class="side-list no-border">
                                    <!-- Single Filter Card -->
                                    <div class="single_filter_card">
                                        <div class="card-body pt-0">
                                            <div class="inner_widget_link">
                                                <ul class="no-ul-list">
                                                    <li>
                                                        <input id="g1" class="checkbox-custom" name="g1"
                                                            type="checkbox">
                                                        <label for="g1"
                                                            class="checkbox-custom-label">All<span>22</span></label>
                                                    </li>
                                                    <li>
                                                        <input id="g2" class="checkbox-custom" name="g2"
                                                            type="checkbox">
                                                        <label for="g2"
                                                            class="checkbox-custom-label">Male<span>472</span></label>
                                                    </li>
                                                    <li>
                                                        <input id="g3" class="checkbox-custom" name="g3"
                                                            type="checkbox">
                                                        <label for="g3"
                                                            class="checkbox-custom-label">Female<span>170</span></label>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Single Option -->
                        <div class="single_search_boxed">
                            <div class="widget-boxed-header">
                                <h4><a href="#discount" data-toggle="collapse" class="collapsed" aria-expanded="false"
                                        role="button">Discount</a></h4>
                            </div>
                            <div class="widget-boxed-body collapse" id="discount" data-parent="#discount">
                                <div class="side-list no-border">
                                    <!-- Single Filter Card -->
                                    <div class="single_filter_card">
                                        <div class="card-body pt-0">
                                            <div class="inner_widget_link">
                                                <ul class="no-ul-list">
                                                    <li>
                                                        <input id="d1" class="checkbox-custom" name="d1"
                                                            type="checkbox">
                                                        <label for="d1" class="checkbox-custom-label">80%
                                                            Discount<span>22</span></label>
                                                    </li>
                                                    <li>
                                                        <input id="d2" class="checkbox-custom" name="d2"
                                                            type="checkbox">
                                                        <label for="d2" class="checkbox-custom-label">60%
                                                            Discount<span>472</span></label>
                                                    </li>
                                                    <li>
                                                        <input id="d3" class="checkbox-custom" name="d3"
                                                            type="checkbox">
                                                        <label for="d3" class="checkbox-custom-label">50%
                                                            Discount<span>170</span></label>
                                                    </li>
                                                    <li>
                                                        <input id="d4" class="checkbox-custom" name="d4"
                                                            type="checkbox">
                                                        <label for="d4" class="checkbox-custom-label">40%
                                                            Discount<span>170</span></label>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Single Option -->
                        <div class="single_search_boxed">
                            <div class="widget-boxed-header">
                                <h4><a href="#types" data-toggle="collapse" class="collapsed" aria-expanded="false"
                                        role="button">Type</a></h4>
                            </div>
                            <div class="widget-boxed-body collapse" id="types" data-parent="#types">
                                <div class="side-list no-border">
                                    <!-- Single Filter Card -->
                                    <div class="single_filter_card">
                                        <div class="card-body pt-0">
                                            <div class="inner_widget_link">
                                                <ul class="no-ul-list">
                                                    <li>
                                                        <input id="t1" class="checkbox-custom" name="t1"
                                                            type="checkbox">
                                                        <label for="t1" class="checkbox-custom-label">All
                                                            Type<span>422</span></label>
                                                    </li>
                                                    <li>
                                                        <input id="t2" class="checkbox-custom" name="t2"
                                                            type="checkbox">
                                                        <label for="t2" class="checkbox-custom-label">Normal
                                                            Type<span>472</span></label>
                                                    </li>
                                                    <li>
                                                        <input id="t3" class="checkbox-custom" name="t3"
                                                            type="checkbox">
                                                        <label for="t3" class="checkbox-custom-label">Simple
                                                            Type<span>170</span></label>
                                                    </li>
                                                    <li>
                                                        <input id="t4" class="checkbox-custom" name="t4"
                                                            type="checkbox">
                                                        <label for="t4" class="checkbox-custom-label">Modern
                                                            type<span>140</span></label>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Single Option -->
                        <div class="single_search_boxed">
                            <div class="widget-boxed-header">
                                <h4><a href="#occation" data-toggle="collapse" class="collapsed" aria-expanded="false"
                                        role="button">Occation</a></h4>
                            </div>
                            <div class="widget-boxed-body collapse" id="occation" data-parent="#occation">
                                <div class="side-list no-border">
                                    <!-- Single Filter Card -->
                                    <div class="single_filter_card">
                                        <div class="card-body pt-0">
                                            <div class="inner_widget_link">
                                                <ul class="no-ul-list">
                                                    <li>
                                                        <input id="o1" class="checkbox-custom" name="o1"
                                                            type="checkbox">
                                                        <label for="o1" class="checkbox-custom-label">All
                                                            Occation<span>422</span></label>
                                                    </li>
                                                    <li>
                                                        <input id="o2" class="checkbox-custom" name="o2"
                                                            type="checkbox">
                                                        <label for="o2" class="checkbox-custom-label">Normal
                                                            Occation<span>472</span></label>
                                                    </li>
                                                    <li>
                                                        <input id="t33" class="checkbox-custom" name="o33"
                                                            type="checkbox">
                                                        <label for="t33" class="checkbox-custom-label">Winter
                                                            Occation<span>170</span></label>
                                                    </li>
                                                    <li>
                                                        <input id="o4" class="checkbox-custom" name="o4"
                                                            type="checkbox">
                                                        <label for="o4" class="checkbox-custom-label">Summer
                                                            Occation<span>140</span></label>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Single Option -->
                        <div class="single_search_boxed">
                            <div class="widget-boxed-header">
                                <h4><a href="#colors" data-toggle="collapse" class="collapsed" aria-expanded="false"
                                        role="button">Colors</a></h4>
                            </div>
                            <div class="widget-boxed-body collapse" id="colors" data-parent="#colors">
                                <div class="side-list no-border">
                                    <!-- Single Filter Card -->
                                    <div class="single_filter_card">
                                        <div class="card-body pt-0">
                                            <div class="text-left">
                                                <div class="form-check form-option form-check-inline mb-1">
                                                    <input class="form-check-input" type="radio" name="colora8"
                                                        id="whitea8">
                                                    <label class="form-option-label rounded-circle" for="whitea8"><span
                                                            class="form-option-color rounded-circle blc7"></span></label>
                                                </div>
                                                <div class="form-check form-option form-check-inline mb-1">
                                                    <input class="form-check-input" type="radio" name="colora8"
                                                        id="bluea8">
                                                    <label class="form-option-label rounded-circle" for="bluea8"><span
                                                            class="form-option-color rounded-circle blc2"></span></label>
                                                </div>
                                                <div class="form-check form-option form-check-inline mb-1">
                                                    <input class="form-check-input" type="radio" name="colora8"
                                                        id="yellowa8">
                                                    <label class="form-option-label rounded-circle" for="yellowa8"><span
                                                            class="form-option-color rounded-circle blc5"></span></label>
                                                </div>
                                                <div class="form-check form-option form-check-inline mb-1">
                                                    <input class="form-check-input" type="radio" name="colora8"
                                                        id="pinka8">
                                                    <label class="form-option-label rounded-circle" for="pinka8"><span
                                                            class="form-option-color rounded-circle blc3"></span></label>
                                                </div>
                                                <div class="form-check form-option form-check-inline mb-1">
                                                    <input class="form-check-input" type="radio" name="colora8"
                                                        id="reda">
                                                    <label class="form-option-label rounded-circle" for="reda"><span
                                                            class="form-option-color rounded-circle blc4"></span></label>
                                                </div>
                                                <div class="form-check form-option form-check-inline mb-1">
                                                    <input class="form-check-input" type="radio" name="colora8"
                                                        id="greena">
                                                    <label class="form-option-label rounded-circle" for="greena"><span
                                                            class="form-option-color rounded-circle blc6"></span></label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <div class="col-xl-9 col-lg-8 col-md-12 col-sm-12">
                <div class="row">
                    <div class="col-xl-12 col-lg-12 col-md-12">
                        <div class="border mb-3 mfliud">
                            <div class="row align-items-center py-2 m-0">
                                <div class="col-xl-3 col-lg-4 col-md-5 col-sm-12">

                                    <h6 class="mb-0" id="product_count">{{ $product->count() }} Items Found</h6>
                                </div>

                                <div class="col-xl-9 col-lg-8 col-md-7 col-sm-12">
                                    <div class="filter_wraps d-flex align-items-center justify-content-end m-start">
                                        <div class="single_fitres mr-2 br-right">
                                            <select class="custom-select simple">
                                                <option value="1" selected="">Default Sorting</option>
                                                <option value="2">Sort by price: Low price</option>
                                                <option value="3">Sort by price: Hight price</option>
                                                <option value="4">Sort by rating</option>
                                                <option value="5">Sort by trending</option>
                                            </select>
                                        </div>
                                        <div class="single_fitres">
                                            <a href="shop-style-5.html" class="simple-button active mr-1"><i
                                                    class="ti-layout-grid2"></i></a>
                                            <a href="shop-list-sidebar.html" class="simple-button"><i
                                                    class="ti-view-list"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- row -->
                <div class="row align-items-center rows-products" id="products">
                    @foreach ($product as $p)
                        <!-- Single -->
                        <div class="col-xl-4 col-lg-4 col-md-6 col-6">
                            <div class="product_grid card b-0">
                                <div class="badge bg-info text-white position-absolute ft-regular ab-left text-upper">
                                    New</div>
                                <div class="card-body p-0">
                                    <div class="shop_thumb position-relative">
                                        <a class="card-img-top d-block overflow-hidden" href={{route('product.specific', $p->slug)}}><img class="card-img-top" src="{{$p->thumbnail}}"
                                                alt="{{$p->name}}"></a>
                                        <div
                                            class="product-hover-overlay bg-dark d-flex align-items-center justify-content-center">

                                            <div class="edlio">
                                                <a href="#" data-toggle="modal" data-target="#quickview"
                                                    class="text-white fs-sm ft-medium quick-view-btn"
                                                    data-name="{{ $p->name }}" data-price="{{ $p->price }}"
                                                    data-id="{{ $p->id }}" data-description="{{ $p->description }}"
                                                    data-gallery="{{ json_encode($p->gallery) }}"
                                                    data-category="{{ $p->category->name }}" data-reviews="412"
                                                    data-old-price="{{ $p->cost_price }}" data-new-price="{{ $p->price }}">
                                                    <i class="fas fa-eye mr-1"></i>Quick View
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer b-0 p-0 pt-2 bg-white">
                                    <div class="d-flex align-items-start justify-content-between">
                                        <div class="text-left">

                                        </div>
                                        <div class="text-right">
                                            <button class="btn auto btn_love snackbar-wishlist" id="wishlist"
                                                onclick="onbtnclick({{$p->id}})">
                                                <i class="far fa-heart"></i>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="text-left">
                                        <h5 class="fw-bolder fs-md mb-0 lh-1 mb-1"><a
                                                href="{{route('product.specific', $p->slug)}}"
                                                id="product_name">{{$p->name}}</a>
                                        </h5>
                                        <div class="elis_rty"><span class="ft-bold text-dark fs-sm"
                                                id="product_price">₹{{$p->price}}</span></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

        </div>
    </div>
</section>
<!-- ======================= All Product List ======================== -->

<!-- ======================= Customer Features ======================== -->
<section class="px-0 py-3 br-top">
    <div class="container">
        <div class="row">

            <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6">
                <div class="d-flex align-items-center justify-content-start py-2">
                    <div class="d_ico">
                        <i class="fas fa-shopping-basket"></i>
                    </div>
                    <div class="d_capt">
                        <h5 class="mb-0">Free Shipping</h5>
                        <span class="text-muted">Capped at $10 per order</span>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6">
                <div class="d-flex align-items-center justify-content-start py-2">
                    <div class="d_ico">
                        <i class="far fa-credit-card"></i>
                    </div>
                    <div class="d_capt">
                        <h5 class="mb-0">Secure Payments</h5>
                        <span class="text-muted">Up to 6 months installments</span>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6">
                <div class="d-flex align-items-center justify-content-start py-2">
                    <div class="d_ico">
                        <i class="fas fa-shield-alt"></i>
                    </div>
                    <div class="d_capt">
                        <h5 class="mb-0">15-Days Returns</h5>
                        <span class="text-muted">Shop with fully confidence</span>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6">
                <div class="d-flex align-items-center justify-content-start py-2">
                    <div class="d_ico">
                        <i class="fas fa-headphones-alt"></i>
                    </div>
                    <div class="d_capt">
                        <h5 class="mb-0">24x7 Fully Support</h5>
                        <span class="text-muted">Get friendly support</span>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>
<div class="modal fade lg-modal" id="quickview" tabindex="-1" role="dialog" aria-labelledby="quickviewmodal"
    aria-hidden="true">
    <div class="modal-dialog modal-xl login-pop-form" role="document">
        <div class="modal-content" id="quickviewmodal">
            <div class="modal-headers">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span class="ti-close"></span>
                </button>
            </div>

            <div class="modal-body">
                <div class="quick_view_wrap">
                    <div class="quick_view_thmb">
                        <div class="quick_view_slide">
                        </div>
                    </div>

                    <div class="quick_view_capt">
                        <div class="prd_details">

                            <div class="prt_01 mb-1"><span class="text-light bg-info rounded px-2 py-1"
                                    id="category">Dresses</span></div>
                            <div class="prt_02 mb-2">
                                <h2 class="ft-bold mb-1">Women Striped Shirt Dress</h2>
                                <div class="text-left">
                                    <div class="star-rating align-items-center d-flex justify-content-left mb-1 p-0">
                                        <i class="fas fa-star filled"></i>
                                        <i class="fas fa-star filled"></i>
                                        <i class="fas fa-star filled"></i>
                                        <i class="fas fa-star filled"></i>
                                        <i class="fas fa-star"></i>
                                        <span class="small">(412 Reviews)</span>
                                    </div>
                                    <div class="elis_rty"><span
                                            class="ft-medium text-muted line-through fs-md mr-2">$199</span><span
                                            class="ft-bold theme-cl fs-lg mr-2">$110</span></div>
                                </div>
                            </div>

                            <div class="prt_03 mb-3">
                                <p>At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis
                                    praesentium voluptatum deleniti atque corrupti quos dolores.</p>
                            </div>

                            <div class="prt_05 mb-4">
                                <div class="form-row mb-7">
                                    <div class="col-12 col-lg-auto">
                                        <!-- Quantity -->
                                        <select class="mb-2 custom-select">
                                            <option value="1" selected="">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5">5</option>
                                        </select>
                                    </div>
                                    <div class="col-12 col-lg">
                                        <!-- Submit -->
                                        <button type="submit" class="btn btn-block custom-height bg-dark mb-2"
                                            id="btnadd">
                                            <i class="lni lni-shopping-basket mr-2"></i>Add to Cart
                                        </button>
                                    </div>
                                    <div class="col-12 col-lg-auto">
                                        <!-- Wishlist -->
                                        <button class="btn custom-height btn-default btn-block mb-2 text-dark"
                                            data-toggle="button" id="wishlist">
                                            <i class="lni lni-heart mr-2"></i>Wishlist
                                        </button>
                                    </div>
                                </div>
                            </div>

                            <div class="prt_06">
                                <p class="mb-0 d-flex align-items-center">
                                    <span class="mr-4">Share:</span>
                                    <a class="d-inline-flex align-items-center justify-content-center p-3 gray circle fs-sm text-muted mr-2"
                                        href="#!">
                                        <i class="fab fa-twitter position-absolute"></i>
                                    </a>
                                    <a class="d-inline-flex align-items-center justify-content-center p-3 gray circle fs-sm text-muted mr-2"
                                        href="#!">
                                        <i class="fab fa-facebook-f position-absolute"></i>
                                    </a>
                                    <a class="d-inline-flex align-items-center justify-content-center p-3 gray circle fs-sm text-muted"
                                        href="#!">
                                        <i class="fab fa-pinterest-p position-absolute"></i>
                                    </a>
                                </p>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Modal -->


<a id="back2Top" class="top-scroll" title="Back to top" href="#"><i class="ti-arrow-up"></i></a>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const arihant = document.querySelector('#alert');
        document.querySelectorAll('.quick-view-btn').forEach(function (button) {
            button.addEventListener('click', function () {

                const productName = this.getAttribute('data-name');
                const productPrice = this.getAttribute('data-price');
                const productDescription = this.getAttribute('data-description');
                const productGallery = JSON.parse(this.getAttribute('data-gallery'));
                const productCategory = this.getAttribute('data-category');
                const productReviews = this.getAttribute('data-reviews');
                const oldPrice = this.getAttribute('data-old-price');
                const newPrice = this.getAttribute('data-new-price');
                const id = this.getAttribute('data-id');

                document.querySelectorAll('#btnadd').forEach(btn => {
                    btn.addEventListener('click', function () {
                        const data = {
                            id: id,
                            quantity: 1,
                            price: productPrice
                        }
                        addToCart(data);
                    });
                });

                document.querySelector('#quickviewmodal .ft-bold.mb-1').innerText = productName;
                document.querySelector('#quickviewmodal .ft-bold.theme-cl.fs-lg.mr-2').innerText = `₹${newPrice}`;
                document.querySelector('#quickviewmodal .ft-medium.text-muted.line-through.fs-md.mr-2').innerText = `₹${oldPrice}`;
                document.querySelector('#quickviewmodal .prt_03.mb-3 p').innerText = productDescription;
                document.querySelector("#category").innerText = productCategory;


                let galleryHTML = '';

                productGallery.forEach(function (image) {
                    galleryHTML += `<div class="single_view_slide"><img src="${image.image}" class="img-fluid" alt="" /></div>`;
                });
                document.querySelector('.quick_view_slide').innerHTML = galleryHTML;

            });
        });

        async function addToCart(params) {
            const quantity = 1;
            const res = await fetch("{{route("cart.add")}}", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": "{{ csrf_token() }}"
                },
                body: JSON.stringify({
                    product_id: params.id,
                    quantity: params.quantity,
                    price: params.price
                }),
            })

            const data = await res.json()
            if (!data.status) {
                arihant.innerHTML = `
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
        ${data.message}
                                              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
												<span aria-hidden="true">&times;</span>
											  </button>
											</div>
                                            `
                window.scrollTo(0, 0);
            }
            else {
                arihant.innerHTML = `
            <div class="alert alert-success alert-dismissible fade show" role="alert">
        ${data.message}
                                              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
												<span aria-hidden="true">&times;</span>
											  </button>
											</div>
                                            `
                window.scrollTo(0, 0);
                window.location.reload();
            }
        }
    });

</script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const productsContainer = document.querySelector('#products');
        const productsCount = document.querySelector('#product_count');

        document.querySelectorAll('.inner_widget_link a').forEach(link => {
            link.addEventListener('click', async function (event) {
                event.preventDefault();
                const categoryId = this.getAttribute('data-id');

                try {
                    const res = await fetch("{{ route('category.show', ':id') }}".replace(':id', categoryId));
                    const data = await res.json();

                    productsContainer.innerHTML = '';
                    productsCount.innerText = data.product.length + " Items Found";

                    data.product.forEach(product => {
                        const productHTML = `
                        <div class="col-xl-4 col-lg-4 col-md-6 col-6">
                            <div class="product_grid card b-0">
                                <div class="badge bg-info text-white position-absolute ft-regular ab-left text-upper">
                                    New
                                </div>
                                <div class="card-body p-0">
                                    <div class="shop_thumb position-relative">
                                        <a class="card-img-top d-block overflow-hidden"
                                           href="{{ route('product.specific', '') }}/${product.slug}">
                                           <img class="card-img-top" src="${product.thumbnail}" alt="${product.name}">
                                        </a>
                                        <div class="product-hover-overlay bg-dark d-flex align-items-center justify-content-center">
                                            <div class="edlio">
                                                <a href="#" data-toggle="modal" data-target="#quickview"
                                                   class="text-white fs-sm ft-medium quick-view-btn"
                                                   data-name="${product.name}" data-price="${product.price}"
                                                   data-description="${product.description}"
                                                   data-gallery='${JSON.stringify(product.gallery)}'
                                                   data-category="${product.category.name}" data-reviews="412"
                                                   data-old-price="${product.cost_price}"
                                                   data-new-price="${product.price}">
                                                   <i class="fas fa-eye mr-1"></i>Quick View
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer b-0 p-0 pt-2 bg-white">
                                    <div class="d-flex align-items-start justify-content-between">
                                        <div class="text-left"></div>
                                        <div class="text-right">
                                            <button class="btn auto btn_love snackbar-wishlist" id="wishlist">
                                                <i class="far fa-heart"></i>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="text-left">
                                        <h5 class="fw-bolder fs-md mb-0 lh-1 mb-1">
                                              <a href="${route('product.specific', '')}}/${product.slug}">${product.name}</a>
                                        </h5>
                                        <div class="elis_rty">
                                            <span class="ft-bold text-dark fs-sm">₹${product.price}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>`;

                        productsContainer.insertAdjacentHTML('beforeend', productHTML);
                    });
                } catch (error) {
                    console.error("Error fetching products:", error);
                }
            });
        });
    });

</script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const productsContainer = document.querySelector('#products');
        const productHtml = productsContainer.innerHTML;
        const productsCount = document.querySelector('#product_count');
        const initialCount = productsCount.innerText;

        document.querySelectorAll('#brand-list input').forEach(checkbox => {
            checkbox.addEventListener('change', async function () {
                const selectedBrandIds = Array.from(document.querySelectorAll('#brand-list input:checked'))
                    .map(cb => cb.getAttribute('data-brand-id'));

                if (selectedBrandIds.length === 0) {
                    productsContainer.innerHTML = productHtml;
                    productsCount.innerText = initialCount;
                    return;
                }

                productsContainer.innerHTML = '';

                try {
                    const res = await fetch("{{ route('brand.filter.show') }}", {
                        method: 'POST',
                        headers: {
                            "Content-Type": "application/json",
                            'X-CSRF-Token': "{{ csrf_token() }}",
                        },
                        body: JSON.stringify({ brandId: selectedBrandIds })
                    });
                    const data = await res.json();

                    productsContainer.innerHTML = '';
                    productsCount.innerText = data.product.data.length + " Items Found";

                    data.product.data.forEach(product => {
                        const productHTML = `
                            <div class="col-xl-4 col-lg-4 col-md-6 col-6">
                                <div class="product_grid card b-0">
                                    <div class="badge bg-info text-white position-absolute ft-regular ab-left text-upper">New</div>
                                    <div class="card-body p-0">
                                        <div class="shop_thumb position-relative">
                                            <a class="card-img-top d-block overflow-hidden" href="{{ route('product.specific', '') }}/${product.slug}">
                                                <img class="card-img-top" src="${product.thumbnail}" alt="${product.name}">
                                            </a>
                                            <div class="product-hover-overlay bg-dark d-flex align-items-center justify-content-center">
                                                <div class="edlio">
                                                    <a href="#" data-toggle="modal" data-target="#quickview"
                                                       class="text-white fs-sm ft-medium quick-view-btn"
                                                       data-name="${product.name}" data-price="${product.price}"
                                                       data-description="${product.description}"
                                                       data-gallery='${JSON.stringify(product.gallery)}'
                                                       data-category="${product.category.name}" data-reviews="412"
                                                       data-old-price="${product.cost_price}"
                                                       data-new-price="${product.price}">
                                                       <i class="fas fa-eye mr-1"></i>Quick View
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-footer b-0 p-0 pt-2 bg-white">
                                        <div class="d-flex align-items-start justify-content-between">
                                            <div class="text-left"></div>
                                            <div class="text-right">
                                                <button class="btn auto btn_love snackbar-wishlist" id="wishlist">
                                                    <i class="far fa-heart"></i>
                                                </button>
                                            </div>
                                        </div>
                                        <div class="text-left">
                                            <h5 class="fw-bolder fs-md mb-0 lh-1 mb-1">
                                                   <a href="{{route('product.specific', '')}}/${product.slug}}">${product.name}</a>
                                            </h5>
                                            <div class="elis_rty">
                                                <span class="ft-bold text-dark fs-sm">₹${product.price}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>`;
                        productsContainer.insertAdjacentHTML('beforeend', productHTML);
                    });
                } catch (error) {
                    console.error("Error fetching products:", error);
                }
            });
        });
    });
</script>

<script>
    const arihant = document.querySelector('#alert');
    async function onbtnclick(id) {
        const res = await fetch("{{route("wishlist.store")}}", {
            method: 'POST',
            headers: {
                "Content-Type": "application/json",
                'X-CSRF-Token': "{{ csrf_token() }}",
            },
            body: JSON.stringify({ product_id: id })
        })

        const data = await res.json();

        if (!data.status) {
            arihant.innerHTML = `
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
        ${data.message}
                                              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
												<span aria-hidden="true">&times;</span>
											  </button>
											</div>
                                            `
            window.scrollTo(0, 0);
        }
        else {
            arihant.innerHTML = `<div class="alert alert-success alert-dismissible fade show" role="alert">
        ${data.message}
											  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
												<span aria-hidden="true">&times;</span>
											  </button>
                                              </div>`
            window.scrollTo(0, 0);
        }

    }
</script>

<script>
    let debounceTimeout;

    async function updateTextInput(value) {
        const productsCount = document.querySelector('#product_count');
        const productsContainer = document.querySelector('#products');
        clearTimeout(debounceTimeout);

        debounceTimeout = setTimeout(async () => {
            const parts = value.split(";");
            if (parts.length !== 2) {
                console.error("Invalid input format");
                return;
            }

            const data = {
                min: parts[0],
                max: parts[1]
            };

            productsContainer.innerHTML = '';
            try {
                const res = await fetch("{{route('price.filter')}}", {
                    method: 'POST',
                    headers: {
                        "Content-Type": "application/json",
                        'X-CSRF-Token': "{{ csrf_token() }}",
                    },
                    body: JSON.stringify(data)
                });

                if (!res.ok) {
                    throw new Error(`Request failed with status ${res.status}`);
                }

                const response = await res.json();

                productsContainer.innerHTML = '';
                productsCount.innerText = response.product.data.length + " Items Found";

                response.product.data.forEach(product => {
                    const productHTML = `
                            <div class="col-xl-4 col-lg-4 col-md-6 col-6">
                                <div class="product_grid card b-0">
                                    <div class="badge bg-info text-white position-absolute ft-regular ab-left text-upper">New</div>
                                    <div class="card-body p-0">
                                        <div class="shop_thumb position-relative">
                                            <a class="card-img-top d-block overflow-hidden" href="{{ route('product.specific', '') }}/${product.slug}">
                                                <img class="card-img-top" src="${product.thumbnail}" alt="${product.name}">
                                            </a>
                                            <div class="product-hover-overlay bg-dark d-flex align-items-center justify-content-center">
                                                <div class="edlio">
                                                    <a href="#" data-toggle="modal" data-target="#quickview"
                                                       class="text-white fs-sm ft-medium quick-view-btn"
                                                       data-name="${product.name}" data-price="${product.price}"
                                                       data-description="${product.description}"
                                                       data-gallery='${JSON.stringify(product.gallery)}'
                                                       data-category="${product.category.name}" data-reviews="412"
                                                       data-old-price="${product.cost_price}"
                                                       data-new-price="${product.price}">
                                                       <i class="fas fa-eye mr-1"></i>Quick View
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-footer b-0 p-0 pt-2 bg-white">
                                        <div class="d-flex align-items-start justify-content-between">
                                            <div class="text-left"></div>
                                            <div class="text-right">
                                                <button class="btn auto btn_love snackbar-wishlist" id="wishlist">
                                                    <i class="far fa-heart"></i>
                                                </button>
                                            </div>
                                        </div>
                                        <div class="text-left">
                                            <h5 class="fw-bolder fs-md mb-0 lh-1 mb-1">
                                                <a href="{{route('product.specific', '')}}/${product.slug}}">${product.name}</a>
                                            </h5>
                                            <div class="elis_rty">
                                                <span class="ft-bold text-dark fs-sm">₹${product.price}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>`;
                    productsContainer.insertAdjacentHTML('beforeend', productHTML);
                });
            } catch (error) {
                console.error("Fetch error:", error);
            }
        }, 300);
    }
</script>

@endsection