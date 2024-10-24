<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="{{asset('assets/css/styles.css')}}" rel="stylesheet">
</head>

<body>
    <div class="preloader"></div>
    <div id="main-wrapper">

        <!-- ============================================================== -->
        <!-- Top header  -->
        <!-- ============================================================== -->
        <div class="py-2 bg-dark">
            <div class="container">
                <div class="row">

                    <div class="col-xl-4 col-lg-4 col-md-5 col-sm-12 hide-ipad">
                        <div class="top_first"><a href="callto:(+84)0123456789" class="medium text-light">(+84) 0123 456
                                789</a></div>
                    </div>

                    <div class="col-xl-4 col-lg-4 col-md-5 col-sm-12 hide-ipad">
                        <div class="top_second text-center">
                            <p class="medium text-light m-0 p-0">Get Free delivery from $2000 <a href="#"
                                    class="medium text-light text-underline">Shop Now</a></p>
                        </div>
                    </div>

                    <!-- Right Menu -->
                    <div class="col-xl-4 col-lg-4 col-md-5 col-sm-12">

                        <div class="currency-selector dropdown js-dropdown float-right">
                            <a href="javascript:void(0);" data-toggle="dropdown" class="popup-title" title="Currency"
                                aria-label="Currency dropdown">
                                <span class="hidden-xl-down medium text-light">Currency:</span>
                                <span class="iso_code medium text-light">$USD</span>
                                <i class="fa fa-angle-down medium text-light"></i>
                            </a>
                            <ul class="popup-content dropdown-menu">
                                <li><a title="Euro" href="#" class="dropdown-item medium text-medium">EUR €</a></li>
                                <li class="current"><a title="US Dollar" href="#"
                                        class="dropdown-item medium text-medium">USD $</a></li>
                            </ul>
                        </div>

                        <!-- Choose Language -->

                        <div class="language-selector-wrapper dropdown js-dropdown float-right mr-3">
                            <a class="popup-title" href="javascript:void(0)" data-toggle="dropdown" title="Language"
                                aria-label="Language dropdown">
                                <span class="hidden-xl-down medium text-light">Language:</span>
                                <span class="iso_code medium text-light">English</span>
                                <i class="fa fa-angle-down medium text-light"></i>
                            </a>
                            <ul class="dropdown-menu popup-content link">
                                <li class="current"><a href="javascript:void(0);"
                                        class="dropdown-item medium text-medium"><img src="assets/img/1.jpg" alt="en"
                                            width="16" height="11" /><span>English</span></a></li>
                                <li><a href="javascript:void(0);" class="dropdown-item medium text-medium"><img
                                            src="assets/img/2.jpg" alt="fr" width="16"
                                            height="11" /><span>Français</span></a></li>
                                <li><a href="javascript:void(0);" class="dropdown-item medium text-medium"><img
                                            src="assets/img/3.jpg" alt="de" width="16"
                                            height="11" /><span>Deutsch</span></a></li>
                                <li><a href="javascript:void(0);" class="dropdown-item medium text-medium"><img
                                            src="assets/img/4.jpg" alt="it" width="16"
                                            height="11" /><span>Italiano</span></a></li>
                                <li><a href="javascript:void(0);" class="dropdown-item medium text-medium"><img
                                            src="assets/img/5.jpg" alt="es" width="16"
                                            height="11" /><span>Español</span></a></li>
                                <li><a href="javascript:void(0);" class="dropdown-item medium text-medium"><img
                                            src="assets/img/6.jpg" alt="ar" width="16" height="11" /><span>اللغة
                                            العربية</span></a></li>
                            </ul>
                        </div>

                        <div class="currency-selector dropdown js-dropdown float-right mr-3">
                            <a href="javascript:void(0);" class="text-light medium">Wishlist</a>
                        </div>

                        <div class="currency-selector dropdown js-dropdown float-right mr-3">
                            <a href="javascript:void(0);" class="text-light medium">My Account</a>
                        </div>

                    </div>

                </div>
            </div>
        </div>

        <!-- Start Navigation -->
        <div class="header header-light dark-text">
            <div class="container">
                <nav id="navigation" class="navigation navigation-landscape">
                    <div class="nav-header">
                        <a class="nav-brand" href="#">
                            <img src="assets/img/logo.png" class="logo" alt="" />
                        </a>
                        <div class="nav-toggle"></div>
                        <div class="mobile_nav">
                            <ul>
                                <li>
                                    <a href="#" onclick="openSearch()">
                                        <i class="lni lni-search-alt"></i>
                                    </a>
                                </li>
                                <li>
                                    <a href="#" data-toggle="modal" data-target="#login">
                                        <i class="lni lni-user"></i>
                                    </a>
                                </li>
                                <li>
                                    <a href="#" onclick="openWishlist()">
                                        <i class="lni lni-heart"></i><span class="dn-counter">2</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#" onclick="openCart()">
                                        <i class="lni lni-shopping-basket"></i><span class="dn-counter">0</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="nav-menus-wrapper" style="transition-property: none;">
                        <ul class="nav-menu">

                            <li><a href="#">Home</a>
                                <ul class="nav-dropdown nav-submenu">
                                    <li><a href="index-2.html">Home 1</a></li>
                                    <li><a href="home-2.html">Home 2</a></li>
                                    <li><a href="home-3.html">Home 3</a></li>
                                    <li><a href="home-4.html">Home 4</a></li>
                                    <li><a href="home-5.html">Home 5</a></li>
                                    <li><a href="home-6.html">Home 6</a></li>
                                    <li><a href="home-7.html">Home 7</a></li>
                                    <li><a href="home-8.html">Home 8</a></li>
                                    <li><a href="home-9.html">Home 9</a></li>
                                    <li><a href="home-10.html">Home 10</a></li>
                                </ul>
                            </li>

                            <li><a href="javascript:void(0);">Shop</a>
                                <ul class="nav-dropdown nav-submenu">
                                    <li><a href="javascript:void(0);">Account Dashboard</a>
                                        <ul class="nav-dropdown nav-submenu">
                                            <li><a href="my-orders.html">My Order</a></li>
                                            <li><a href="wishlist.html">Wishlist</a></li>
                                            <li><a href="profile-info.html">Profile Info</a></li>
                                            <li><a href="addresses.html">Addresses</a></li>
                                            <li><a href="payment-methode.html">Payment Methode</a></li>
                                        </ul>
                                    </li>
                                    <li><a href="javascript:void(0);">Support</a>
                                        <ul class="nav-dropdown nav-submenu">
                                            <li><a href="shoping-cart.html">Shopping Cart</a></li>
                                            <li><a href="checkout.html">Checkout</a></li>
                                            <li><a href="complete-order.html">Order Complete</a></li>
                                        </ul>
                                    </li>
                                    <li><a href="shop-style-1.html">Shop Style 01</a></li>
                                    <li><a href="shop-style-2.html">Shop Style 02</a></li>
                                    <li><a href="shop-style-3.html">Shop Style 03</a></li>
                                    <li><a href="shop-style-4.html">Shop Style 04</a></li>
                                    <li><a href="shop-style-5.html">Shop Style 05</a></li>
                                    <li><a href="shop-list-view.html">Shop List Style</a></li>
                                </ul>
                            </li>

                            <li><a href="javascript:void(0);">Product</a>
                                <ul class="nav-dropdown nav-submenu">
                                    <li><a href="shop-single-v1.html">Product Detail v01</a></li>
                                    <li><a href="shop-single-v2.html">Product Detail v02</a></li>
                                    <li><a href="shop-single-v3.html">Product Detail v03</a></li>
                                    <li><a href="shop-single-v4.html">Product Detail v04</a></li>
                                </ul>
                            </li>

                            <li><a href="javascript:void(0);">Pages</a>
                                <ul class="nav-dropdown nav-submenu">
                                    <li><a href="blog.html">Blog Style</a></li>
                                    <li><a href="about-us.html">About Us</a></li>
                                    <li><a href="contact.html">Contact</a></li>
                                    <li><a href="404.html">404 Page</a></li>
                                    <li><a href="privacy.html">Privacy Policy</a></li>
                                    <li><a href="faq.html">FAQs</a></li>
                                </ul>
                            </li>

                            <li><a href="docs.html">Docs</a></li>

                        </ul>

                        <ul class="nav-menu nav-menu-social align-to-right">
                            <li>
                                <a href="#" onclick="openSearch()">
                                    <i class="lni lni-search-alt"></i>
                                </a>
                            </li>
                            <li>
                                <a href="#" data-toggle="modal" data-target="#login">
                                    <i class="lni lni-user"></i>
                                </a>
                            </li>
                            <li>
                                <a href="#" onclick="openWishlist()">
                                    <i class="lni lni-heart"></i><span class="dn-counter bg-danger">2</span>
                                </a>
                            </li>
                            <li>
                                <a href="#" onclick="openCart()">
                                    <i class="lni lni-shopping-basket"></i><span class="dn-counter bg-success">3</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </nav>
            </div>
        </div>
        <!-- End Navigation -->
        <div class="clearfix"></div>
        <!-- ============================================================== -->
        <!-- Top header  -->
        <!-- ============================================================== -->

        <!-- ======================= Shop Style 1 ======================== -->
        <section class="bg-cover" style="background:url(assets/img/banner-2.png) no-repeat;">
            <div class="container">
                <div class="row align-items-center justify-content-center">
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                        <div class="text-left py-5 mt-3 mb-3">
                            <h1 class="ft-medium mb-3">Shop</h1>
                            <ul class="shop_categories_list m-0 p-0">
                                <li><a href="#">Men</a></li>
                                <li><a href="#">Speakers</a></li>
                                <li><a href="#">Women</a></li>
                                <li><a href="#">Accessories</a></li>
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

                                                <!-- Single Filter Card -->
                                                <div class="single_filter_card">
                                                    <h5><a href="#shoes" data-toggle="collapse" class="collapsed"
                                                            aria-expanded="false" role="button">Shoes<i
                                                                class="accordion-indicator ti-angle-down"></i></a></h5>

                                                    <div class="collapse" id="shoes" data-parent="#shop-categories">
                                                        <div class="card-body">
                                                            <div class="inner_widget_link">
                                                                <ul>
                                                                    <li><a href="#">Pumps & high
                                                                            Heals<span>112</span></a></li>
                                                                    <li><a href="#">Sandels<span>82</span></a></li>
                                                                    <li><a href="#">Sneakers<span>56</span></a></li>
                                                                    <li><a href="#">Boots<span>101</span></a></li>
                                                                    <li><a href="#">Casual Shoes<span>212</span></a>
                                                                    </li>
                                                                    <li><a href="#">Flats Sandel<span>92</span></a></li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- Single Filter Card -->
                                                <div class="single_filter_card">
                                                    <h5><a href="#clothing" data-toggle="collapse" class=""
                                                            aria-expanded="false" role="button">Clothing<i
                                                                class="accordion-indicator ti-angle-down"></i></a></h5>

                                                    <div class="collapse show" id="clothing"
                                                        data-parent="#shop-categories">
                                                        <div class="card-body">
                                                            <div class="inner_widget_link">
                                                                <ul>
                                                                    <li><a href="#">Blazers<span>82</span></a></li>
                                                                    <li><a href="#">Men Suits<span>110</span></a></li>
                                                                    <li><a href="#">Blouses<span>103</span></a></li>
                                                                    <li><a href="#">Coat Pant<span>72</span></a></li>
                                                                    <li><a href="#">T-Shirts<span>36</span></a></li>
                                                                    <li><a href="#">Men Shirts<span>122</span></a></li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- Single Filter Card -->
                                                <div class="single_filter_card">
                                                    <h5><a href="#watches" data-toggle="collapse" class="collapsed"
                                                            aria-expanded="false" role="button">Watches<i
                                                                class="accordion-indicator ti-angle-down"></i></a></h5>

                                                    <div class="collapse" id="watches" data-parent="#shop-categories">
                                                        <div class="card-body">
                                                            <div class="inner_widget_link">
                                                                <ul>
                                                                    <li><a href="#">Sport Watches<span>112</span></a>
                                                                    </li>
                                                                    <li><a href="#">Casual Watches<span>112</span></a>
                                                                    </li>
                                                                    <li><a href="#">Fashion Watches<span>112</span></a>
                                                                    </li>
                                                                    <li><a href="#">Girls Watches<span>112</span></a>
                                                                    </li>
                                                                    <li><a href="#">Smart Watches<span>112</span></a>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- Single Filter Card -->
                                                <div class="single_filter_card">
                                                    <h5><a href="#bags" data-toggle="collapse" class="collapsed"
                                                            aria-expanded="false" role="button">Bags<i
                                                                class="accordion-indicator ti-angle-down"></i></a></h5>

                                                    <div class="collapse" id="bags" data-parent="#shop-categories">
                                                        <div class="card-body">
                                                            <div class="inner_widget_link">
                                                                <ul>
                                                                    <li><a href="#">Casual Bags<span>212</span></a></li>
                                                                    <li><a href="#">Sport Bags<span>212</span></a></li>
                                                                    <li><a href="#">Lugges bags<span>82</span></a></li>
                                                                    <li><a href="#">Fashion Bags<span>212</span></a>
                                                                    </li>
                                                                    <li><a href="#">Small bags<span>113</span></a></li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- Single Filter Card -->
                                                <div class="single_filter_card">
                                                    <h5><a href="#accessories" data-toggle="collapse" class="collapsed"
                                                            aria-expanded="false" role="button">Accessories<i
                                                                class="accordion-indicator ti-angle-down"></i></a></h5>

                                                    <div class="collapse" id="accessories"
                                                        data-parent="#shop-categories">
                                                        <div class="card-body">
                                                            <div class="inner_widget_link">
                                                                <ul>
                                                                    <li><a href="#">Men Wallet<span>432</span></a></li>
                                                                    <li><a href="#">Men Belt<span>82</span></a></li>
                                                                    <li><a href="#">Hats<span>541</span></a></li>
                                                                    <li><a href="#">Jwelery<span>312</span></a></li>
                                                                    <li><a href="#">Beauty<span>65</span></a></li>
                                                                    <li><a href="#">Cosmetic<span>242</span></a></li>
                                                                </ul>
                                                            </div>
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
                                        <h4><a href="#pricing" data-toggle="collapse" aria-expanded="false"
                                                role="button">Pricing</a></h4>
                                    </div>
                                    <div class="widget-boxed-body collapse show" id="pricing" data-parent="#pricing">
                                        <div class="side-list no-border mb-4">
                                            <div class="rg-slider">
                                                <input type="text" class="js-range-slider" name="my_range" value="" />
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Single Option -->
                                <div class="single_search_boxed">
                                    <div class="widget-boxed-header">
                                        <h4><a href="#size" data-toggle="collapse" class="collapsed"
                                                aria-expanded="false" role="button">Size</a></h4>
                                    </div>
                                    <div class="widget-boxed-body collapse" id="size" data-parent="#size">
                                        <div class="side-list no-border">
                                            <!-- Single Filter Card -->
                                            <div class="single_filter_card">
                                                <div class="card-body pt-0">
                                                    <div class="text-left pb-0 pt-2">
                                                        <div class="form-check form-option form-check-inline mb-2">
                                                            <input class="form-check-input" type="radio" name="sizes"
                                                                id="26s">
                                                            <label class="form-option-label" for="26s">26</label>
                                                        </div>
                                                        <div class="form-check form-option form-check-inline mb-2">
                                                            <input class="form-check-input" type="radio" name="sizes"
                                                                id="28s">
                                                            <label class="form-option-label" for="28s">28</label>
                                                        </div>
                                                        <div class="form-check form-option form-check-inline mb-2">
                                                            <input class="form-check-input" type="radio" name="sizes"
                                                                id="30s" checked>
                                                            <label class="form-option-label" for="30s">30</label>
                                                        </div>
                                                        <div class="form-check form-option form-check-inline mb-2">
                                                            <input class="form-check-input" type="radio" name="sizes"
                                                                id="32s">
                                                            <label class="form-option-label" for="32s">32</label>
                                                        </div>
                                                        <div class="form-check form-option form-check-inline mb-2">
                                                            <input class="form-check-input" type="radio" name="sizes"
                                                                id="34s">
                                                            <label class="form-option-label" for="34s">34</label>
                                                        </div>
                                                        <div class="form-check form-option form-check-inline mb-2">
                                                            <input class="form-check-input" type="radio" name="sizes"
                                                                id="36s">
                                                            <label class="form-option-label" for="36s">36</label>
                                                        </div>
                                                        <div class="form-check form-option form-check-inline mb-2">
                                                            <input class="form-check-input" type="radio" name="sizes"
                                                                id="38s">
                                                            <label class="form-option-label" for="38s">38</label>
                                                        </div>
                                                        <div class="form-check form-option form-check-inline mb-2">
                                                            <input class="form-check-input" type="radio" name="sizes"
                                                                id="40s">
                                                            <label class="form-option-label" for="40s">40</label>
                                                        </div>
                                                        <div class="form-check form-option form-check-inline mb-2">
                                                            <input class="form-check-input" type="radio" name="sizes"
                                                                id="42s">
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
                                        <h4><a href="#brands" data-toggle="collapse" aria-expanded="false"
                                                role="button">Brands</a></h4>
                                    </div>
                                    <div class="widget-boxed-body collapse show" id="brands" data-parent="#brands">
                                        <div class="side-list no-border">
                                            <!-- Single Filter Card -->
                                            <div class="single_filter_card">
                                                <div class="card-body pt-0">
                                                    <div class="inner_widget_link">
                                                        <ul class="no-ul-list">
                                                            <li>
                                                                <input id="b1" class="checkbox-custom" name="b1"
                                                                    type="checkbox">
                                                                <label for="b1"
                                                                    class="checkbox-custom-label">Sumsung<span>142</span></label>
                                                            </li>
                                                            <li>
                                                                <input id="b2" class="checkbox-custom" name="b2"
                                                                    type="checkbox">
                                                                <label for="b2"
                                                                    class="checkbox-custom-label">Apple<span>652</span></label>
                                                            </li>
                                                            <li>
                                                                <input id="b3" class="checkbox-custom" name="b3"
                                                                    type="checkbox">
                                                                <label for="b3"
                                                                    class="checkbox-custom-label">Nike<span>232</span></label>
                                                            </li>
                                                            <li>
                                                                <input id="b4" class="checkbox-custom" name="b4"
                                                                    type="checkbox">
                                                                <label for="b4"
                                                                    class="checkbox-custom-label">Reebok<span>192</span></label>
                                                            </li>
                                                            <li>
                                                                <input id="b5" class="checkbox-custom" name="b5"
                                                                    type="checkbox">
                                                                <label for="b5"
                                                                    class="checkbox-custom-label">Hawai<span>265</span></label>
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
                                        <h4><a href="#gender" data-toggle="collapse" class="collapsed"
                                                aria-expanded="false" role="button">Gender</a></h4>
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
                                        <h4><a href="#discount" data-toggle="collapse" class="collapsed"
                                                aria-expanded="false" role="button">Discount</a></h4>
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
                                        <h4><a href="#types" data-toggle="collapse" class="collapsed"
                                                aria-expanded="false" role="button">Type</a></h4>
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
                                        <h4><a href="#occation" data-toggle="collapse" class="collapsed"
                                                aria-expanded="false" role="button">Occation</a></h4>
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
                                        <h4><a href="#colors" data-toggle="collapse" class="collapsed"
                                                aria-expanded="false" role="button">Colors</a></h4>
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
                                                            <label class="form-option-label rounded-circle"
                                                                for="whitea8"><span
                                                                    class="form-option-color rounded-circle blc7"></span></label>
                                                        </div>
                                                        <div class="form-check form-option form-check-inline mb-1">
                                                            <input class="form-check-input" type="radio" name="colora8"
                                                                id="bluea8">
                                                            <label class="form-option-label rounded-circle"
                                                                for="bluea8"><span
                                                                    class="form-option-color rounded-circle blc2"></span></label>
                                                        </div>
                                                        <div class="form-check form-option form-check-inline mb-1">
                                                            <input class="form-check-input" type="radio" name="colora8"
                                                                id="yellowa8">
                                                            <label class="form-option-label rounded-circle"
                                                                for="yellowa8"><span
                                                                    class="form-option-color rounded-circle blc5"></span></label>
                                                        </div>
                                                        <div class="form-check form-option form-check-inline mb-1">
                                                            <input class="form-check-input" type="radio" name="colora8"
                                                                id="pinka8">
                                                            <label class="form-option-label rounded-circle"
                                                                for="pinka8"><span
                                                                    class="form-option-color rounded-circle blc3"></span></label>
                                                        </div>
                                                        <div class="form-check form-option form-check-inline mb-1">
                                                            <input class="form-check-input" type="radio" name="colora8"
                                                                id="reda">
                                                            <label class="form-option-label rounded-circle"
                                                                for="reda"><span
                                                                    class="form-option-color rounded-circle blc4"></span></label>
                                                        </div>
                                                        <div class="form-check form-option form-check-inline mb-1">
                                                            <input class="form-check-input" type="radio" name="colora8"
                                                                id="greena">
                                                            <label class="form-option-label rounded-circle"
                                                                for="greena"><span
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
                                            <h6 class="mb-0">{{ $product->count() }} Items Found</h6>
                                        </div>

                                        <div class="col-xl-9 col-lg-8 col-md-7 col-sm-12">
                                            <div
                                                class="filter_wraps d-flex align-items-center justify-content-end m-start">
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
                        <div class="row align-items-center rows-products">
                            @foreach ($product as $p)
                                <!-- Single -->
                                <div class="col-xl-4 col-lg-4 col-md-6 col-6">
                                    <div class="product_grid card b-0">
                                        <div
                                            class="badge bg-info text-white position-absolute ft-regular ab-left text-upper">
                                            New</div>
                                        <div class="card-body p-0">
                                            <div class="shop_thumb position-relative">
                                                <a class="card-img-top d-block overflow-hidden"
                                                    href={{route('product.specific', $p->slug)}}><img class="card-img-top"
                                                        src="{{$p->thumbnail}}" alt="{{$p->name}}"></a>
                                                <div
                                                    class="product-hover-overlay bg-dark d-flex align-items-center justify-content-center">

                                                    <div class="edlio">
                                                        <a href="#" data-toggle="modal" data-target="#quickview"
                                                            class="text-white fs-sm ft-medium quick-view-btn"
                                                            data-name="{{ $p->name }}" data-price="{{ $p->price }}"
                                                            data-description="{{ $p->description }}"
                                                            data-gallery="{{ json_encode($p->gallery) }}"
                                                            data-category="{{ $p->category->name }}" data-reviews="412"
                                                            data-old-price="{{ $p->cost_price }}"
                                                            data-new-price="{{ $p->price }}">
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
                                                    <button class="btn auto btn_love snackbar-wishlist"><i
                                                            class="far fa-heart"></i></button>
                                                </div>
                                            </div>
                                            <div class="text-left">
                                                <h5 class="fw-bolder fs-md mb-0 lh-1 mb-1"><a
                                                        href="shop-single-v1.html">{{$p->name}}</a></h5>
                                                <div class="elis_rty"><span
                                                        class="ft-bold text-dark fs-sm">₹{{$p->price}}</span></div>
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
        <!-- ======================= Customer Features ======================== -->

        <!-- ============================ Footer Start ================================== -->
        <footer class="dark-footer skin-dark-footer style-2">
            <div class="footer-middle">
                <div class="container">
                    <div class="row">

                        <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12">
                            <div class="footer_widget">
                                <img src="assets/img/logo-light.png" class="img-footer small mb-2" alt="" />

                                <div class="address mt-3">
                                    3298 Grant Street Longview, TX<br>United Kingdom 75601
                                </div>
                                <div class="address mt-3">
                                    1-202-555-0106<br>help@shopper.com
                                </div>
                                <div class="address mt-3">
                                    <ul class="list-inline">
                                        <li class="list-inline-item"><a href="#"><i
                                                    class="lni lni-facebook-filled"></i></a></li>
                                        <li class="list-inline-item"><a href="#"><i
                                                    class="lni lni-twitter-filled"></i></a></li>
                                        <li class="list-inline-item"><a href="#"><i class="lni lni-youtube"></i></a>
                                        </li>
                                        <li class="list-inline-item"><a href="#"><i
                                                    class="lni lni-instagram-filled"></i></a></li>
                                        <li class="list-inline-item"><a href="#"><i
                                                    class="lni lni-linkedin-original"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-2 col-lg-2 col-md-2 col-sm-12">
                            <div class="footer_widget">
                                <h4 class="widget_title">Supports</h4>
                                <ul class="footer-menu">
                                    <li><a href="#">Contact Us</a></li>
                                    <li><a href="#">About Page</a></li>
                                    <li><a href="#">Size Guide</a></li>
                                    <li><a href="#">Shipping & Returns</a></li>
                                    <li><a href="#">FAQ's Page</a></li>
                                    <li><a href="#">Privacy</a></li>
                                </ul>
                            </div>
                        </div>

                        <div class="col-xl-2 col-lg-2 col-md-2 col-sm-12">
                            <div class="footer_widget">
                                <h4 class="widget_title">Shop</h4>
                                <ul class="footer-menu">
                                    <li><a href="#">Men's Shopping</a></li>
                                    <li><a href="#">Women's Shopping</a></li>
                                    <li><a href="#">Kids's Shopping</a></li>
                                    <li><a href="#">Furniture</a></li>
                                    <li><a href="#">Discounts</a></li>
                                </ul>
                            </div>
                        </div>

                        <div class="col-xl-2 col-lg-2 col-md-2 col-sm-12">
                            <div class="footer_widget">
                                <h4 class="widget_title">Company</h4>
                                <ul class="footer-menu">
                                    <li><a href="#">About</a></li>
                                    <li><a href="#">Blog</a></li>
                                    <li><a href="#">Affiliate</a></li>
                                    <li><a href="#">Login</a></li>
                                </ul>
                            </div>
                        </div>

                        <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12">
                            <div class="footer_widget">
                                <h4 class="widget_title">Subscribe</h4>
                                <p>Receive updates, hot deals, discounts sent straignt in your inbox daily</p>
                                <div class="foot-news-last">
                                    <div class="input-group">
                                        <input type="text" class="form-control" placeholder="Email Address">
                                        <div class="input-group-append">
                                            <button type="button" class="input-group-text b-0 text-light"><i
                                                    class="lni lni-arrow-right"></i></button>
                                        </div>
                                    </div>
                                </div>
                                <div class="address mt-3">
                                    <h5 class="fs-sm text-light">Secure Payments</h5>
                                    <div class="scr_payment"><img src="assets/img/card.png" class="img-fluid" alt="" />
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

            <div class="footer-bottom">
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-lg-12 col-md-12 text-center">
                            <p class="mb-0">© 2024 Arihant Jain.</p>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
        <!-- ============================ Footer End ================================== -->

        <!-- Product View Modal -->
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
                                            <div
                                                class="star-rating align-items-center d-flex justify-content-left mb-1 p-0">
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
                                                <button type="submit" class="btn btn-block custom-height bg-dark mb-2">
                                                    <i class="lni lni-shopping-basket mr-2"></i>Add to Cart
                                                </button>
                                            </div>
                                            <div class="col-12 col-lg-auto">
                                                <!-- Wishlist -->
                                                <button class="btn custom-height btn-default btn-block mb-2 text-dark"
                                                    data-toggle="button">
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
    </div>


    <script src="{{asset('assets/js/jquery.min.js')}}" defer></script>
    <script src="{{asset('assets/js/popper.min.js')}}" defer></script>
    <script src="{{asset('assets/js/bootstrap.min.js')}}" defer></script>
    <script src="{{asset('assets/js/ion.rangeSlider.min.js')}}" defer></script>
    <script src="{{asset('assets/js/slick.js')}}" defer></script>
    <script src="{{asset('assets/js/slider-bg.js')}}" defer></script>
    <script src="{{asset('assets/js/lightbox.js')}}" defer></script>
    <script src="{{asset('assets/js/smoothproducts.js')}}" defer></script>
    <script src="{{asset('assets/js/snackbar.min.js')}}" defer></script>
    <script src="{{asset('assets/js/jQuery.style.switcher.js')}}" defer></script>
    <script src="{{asset('assets/js/custom.js')}}" defer></script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            document.querySelectorAll('.quick-view-btn').forEach(function (button) {
                button.addEventListener('click', function () {
                    // Get product data from data attributes
                    const productName = this.getAttribute('data-name');
                    const productPrice = this.getAttribute('data-price');
                    const productDescription = this.getAttribute('data-description');
                    const productGallery = JSON.parse(this.getAttribute('data-gallery'));
                    const productCategory = this.getAttribute('data-category');
                    const productReviews = this.getAttribute('data-reviews');
                    const oldPrice = this.getAttribute('data-old-price');
                    const newPrice = this.getAttribute('data-new-price');

                    // Update modal content
                    document.querySelector('#quickviewmodal .ft-bold.mb-1').innerText = productName;
                    document.querySelector('#quickviewmodal .ft-bold.theme-cl.fs-lg.mr-2').innerText = `₹${newPrice}`;
                    document.querySelector('#quickviewmodal .ft-medium.text-muted.line-through.fs-md.mr-2').innerText = `₹${oldPrice}`;
                    document.querySelector('#quickviewmodal .prt_03.mb-3 p').innerText = productDescription;
                    document.querySelector("#category").innerText = productCategory;

                    // Update gallery images
                    let galleryHTML = '';

                    productGallery.forEach(function (image) {
                        galleryHTML += `<div class="single_view_slide"><img src="${image.image}" class="img-fluid" alt="" /></div>`;
                    });
                    document.querySelector('.quick_view_slide').innerHTML = galleryHTML;

                });
            });
        });

    </script>

</body>

</html>