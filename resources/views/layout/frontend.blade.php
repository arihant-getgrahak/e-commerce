<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="{{asset('assets/css/styles.css')}}" rel="stylesheet">
    <meta name="_token" content="{{ csrf_token() }}">
</head>

<body>
    <div class="preloader"></div>
    <div id="main-wrapper">
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
                        <a class="nav-brand" href="/">
                            <img src="{{asset('assets/img/logo.png')}}" class="logo" alt="" />
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
        <div class="gray py-3">
            <div class="container">
                <div class="row">
                    <div class="colxl-12 col-lg-12 col-md-12">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item"><a href="#">Pages</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Login</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
        @yield('section')
        <footer class="dark-footer skin-dark-footer style-2">
            <div class="footer-middle">
                <div class="container">
                    <div class="row">

                        <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12">
                            <div class="footer_widget">

                                <img src="{{asset('assets/img/logo-light.png')}}" class="img-footer small mb-2"
                                    alt="" />

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

        <!-- Log In Modal -->
        <div class="modal fade" id="login" tabindex="-1" role="dialog" aria-labelledby="loginmodal" aria-hidden="true">
            <div class="modal-dialog modal-xl login-pop-form" role="document">
                <div class="modal-content" id="loginmodal">
                    <div class="modal-headers">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span class="ti-close"></span>
                        </button>
                    </div>

                    <div class="modal-body p-5">
                        <div class="text-center mb-4">
                            <h2 class="m-0 ft-regular">Login</h2>
                        </div>

                        <form action="{{ route('login') }}" method="post" autocomplete="off">
                            @csrf
                            <div class="form-group">
                                <label>Email</label>
                                <input type="email" class="form-control" placeholder="your@email.com" autocomplete="off"
                                    name="email" id="email" value="{{ old('email') }}">
                                @error('email')
                                    <p class="text-red-500">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label>Password</label>
                                <input type="password" class="form-control" placeholder="Password*" name="password"
                                    id="password">
                                @error('password')
                                    <p class="text-red-500">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="form-group">
                                <button type="submit"
                                    class="btn btn-md full-width bg-dark text-light fs-md ft-medium">Login</button>
                            </div>

                            <div class="form-group text-center mb-0">
                                <p class="extra">Not a member?<a href="#et-register-wrap" class="text-dark">
                                        Register</a></p>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Modal -->
    </div>

    <script src="{{asset('assets/js/jquery.min.js')}}"></script>
    <script src="{{asset('assets/js/popper.min.js')}}"></script>
    <script src="{{asset('assets/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('assets/js/ion.rangeSlider.min.js')}}"></script>
    <script src="{{asset('assets/js/slick.js')}}"></script>
    <script src="{{asset('assets/js/slider-bg.js')}}"></script>
    <script src="{{asset('assets/js/lightbox.js')}}"></script>
    <script src="{{asset('assets/js/smoothproducts.js')}}"></script>
    <script src="{{asset('assets/js/snackbar.min.js')}}"></script>
    <script src="{{asset('assets/js/jQuery.style.switcher.js')}}"></script>
    <script src="{{asset('assets/js/custom.js')}}"></script>

</body>

</html>