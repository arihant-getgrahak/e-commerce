<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Specific Product</title>

    <link href="{{asset('assets/css/styles.css')}}" rel="stylesheet">
</head>

<body>
    <div class="preloader"></div>
    @if (count($product) == 0)
        <h1>No Products</h1>
    @else
        <div id="main-wrapper">
            <div class="header header-light dark-text">
                <div class="container">
                    <nav id="navigation" class="navigation navigation-landscape">
                        <div class="nav-header">
                            <a class="nav-brand" href="#">
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
            <div class="clearfix"></div>
            <section class="middle">
                <div class="container">
                    <div class="row">
                        <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12">
                            <div class="sp-loading"><img src=" {{asset('assets/img/product/15.png')}}" alt=""><br>LOADING
                                IMAGES</div>
                            <div class="sp-wrap">
                                @foreach ($product[0]->gallery as $image)
                                    <a href="{{$image->image}}"><img src="{{$image->image}}" alt="{{$image->image}}"></a>
                                @endforeach
                            </div>
                        </div>

                        <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12">
                            <div class="prd_details">

                                <div class="prt_01 mb-1"><span
                                        class="text-purple bg-light-purple rounded py-1">{{$product[0]->category->name}}</span>
                                </div>
                                <div class="prt_02 mb-3">
                                    <h2 class="ft-bold mb-1">{{$product[0]->name}}</h2>
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
                                                class="ft-medium text-muted line-through fs-md mr-2">₹{{$product[0]->cost_price}}</span><span
                                                class="ft-bold theme-cl fs-lg mr-2">₹{{$product[0]->price}}</span><span
                                                class="ft-regular text-light bg-success py-1 px-2 fs-sm">In Stock</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="prt_03 mb-4">
                                    <p>{{$product[0]->description}}</p>
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
                                    </div>
                                </div>

                                <div class="prt_06">
                                    <p class="mb-0 d-flex align-items-center">
                                        <span class="mr-4">Share:</span>
                                        <a class="d-inline-flex align-items-center justify-content-center p-3 gray circle fs-sm text-muted mr-2"
                                            href="https://twitter.com/arihantjain916" target="_blank">
                                            <i class="fab fa-twitter position-absolute"></i>
                                        </a>
                                        <a class="d-inline-flex align-items-center justify-content-center p-3 gray circle fs-sm text-muted mr-2"
                                            href="https://www.instagram.com/arihantjain916" target="_blank">
                                            <i class="fab fa-facebook-f position-absolute"></i>
                                        </a>
                                    </p>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <section class="middle">
                <div class="container">
                    <div class="row align-items-center justify-content-center">
                        <div class="col-xl-11 col-lg-12 col-md-12 col-sm-12">
                            <ul class="nav nav-tabs b-0 d-flex align-items-center justify-content-center simple_tab_links mb-4"
                                id="myTab" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link active" id="description-tab" href="#description" data-toggle="tab"
                                        role="tab" aria-controls="description" aria-selected="true">Description</a>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link" href="#information" id="information-tab" data-toggle="tab"
                                        role="tab" aria-controls="information" aria-selected="false">Additional
                                        information</a>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link" href="#reviews" id="reviews-tab" data-toggle="tab" role="tab"
                                        aria-controls="reviews" aria-selected="false">Reviews</a>
                                </li>
                            </ul>

                            <div class="tab-content" id="myTabContent">

                                <!-- Description Content -->
                                <div class="tab-pane fade show active" id="description" role="tabpanel"
                                    aria-labelledby="description-tab">
                                    <div class="description_info">
                                        <p class="p-0 mb-2">{{$product[0]->description}}</p>
                                    </div>
                                </div>

                                <!-- Additional Content -->
                                <div class="tab-pane fade" id="information" role="tabpanel"
                                    aria-labelledby="information-tab">
                                    <div class="additionals">
                                        <table class="table">
                                            <tbody>
                                                <tr>
                                                    <th class="ft-medium text-dark">ID</th>
                                                    <td>{{$product[0]->id}}</td>
                                                </tr>
                                                <tr>
                                                    <th class="ft-medium text-dark">SKU</th>
                                                    <td>{{$product[0]->meta[0]->sku}}</td>
                                                </tr>


                                                <tr>
                                                    <th class="ft-medium text-dark">Weight</th>
                                                    <td>{{$product[0]->meta[0]->weight}}</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                                <!-- Reviews Content -->
                                <div class="tab-pane fade" id="reviews" role="tabpanel" aria-labelledby="reviews-tab">
                                    <div class="reviews_info">
                                        <div class="single_rev d-flex align-items-start br-bottom py-3">
                                            <div class="single_rev_thumb"><img src="assets/img/team-1.jpg"
                                                    class="img-fluid circle" width="90" alt="" /></div>
                                            <div class="single_rev_caption d-flex align-items-start pl-3">
                                                <div class="single_capt_left">
                                                    <h5 class="mb-0 fs-md ft-medium lh-1">Daniel Rajdesh</h5>
                                                    <span class="small">30 jul 2021</span>
                                                    <p>At vero eos et accusamus et iusto odio dignissimos ducimus qui
                                                        blanditiis praesentium voluptatum deleniti atque corrupti quos
                                                        dolores et quas molestias excepturi sint occaecati cupiditate non
                                                        provident, similique sunt in culpa qui officia deserunt mollitia
                                                        animi, id est laborum</p>
                                                </div>
                                                <div class="single_capt_right">
                                                    <div
                                                        class="star-rating align-items-center d-flex justify-content-left mb-1 p-0">
                                                        <i class="fas fa-star filled"></i>
                                                        <i class="fas fa-star filled"></i>
                                                        <i class="fas fa-star filled"></i>
                                                        <i class="fas fa-star filled"></i>
                                                        <i class="fas fa-star filled"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Single Review -->
                                        <div class="single_rev d-flex align-items-start br-bottom py-3">
                                            <div class="single_rev_thumb"><img src="assets/img/team-2.jpg"
                                                    class="img-fluid circle" width="90" alt="" /></div>
                                            <div class="single_rev_caption d-flex align-items-start pl-3">
                                                <div class="single_capt_left">
                                                    <h5 class="mb-0 fs-md ft-medium lh-1">Seema Gupta</h5>
                                                    <span class="small">30 Aug 2021</span>
                                                    <p>At vero eos et accusamus et iusto odio dignissimos ducimus qui
                                                        blanditiis praesentium voluptatum deleniti atque corrupti quos
                                                        dolores et quas molestias excepturi sint occaecati cupiditate non
                                                        provident, similique sunt in culpa qui officia deserunt mollitia
                                                        animi, id est laborum</p>
                                                </div>
                                                <div class="single_capt_right">
                                                    <div
                                                        class="star-rating align-items-center d-flex justify-content-left mb-1 p-0">
                                                        <i class="fas fa-star filled"></i>
                                                        <i class="fas fa-star filled"></i>
                                                        <i class="fas fa-star filled"></i>
                                                        <i class="fas fa-star filled"></i>
                                                        <i class="fas fa-star filled"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Single Review -->
                                        <div class="single_rev d-flex align-items-start br-bottom py-3">
                                            <div class="single_rev_thumb"><img src="assets/img/team-3.jpg"
                                                    class="img-fluid circle" width="90" alt="" /></div>
                                            <div class="single_rev_caption d-flex align-items-start pl-3">
                                                <div class="single_capt_left">
                                                    <h5 class="mb-0 fs-md ft-medium lh-1">Mark Jugermi</h5>
                                                    <span class="small">10 Oct 2021</span>
                                                    <p>At vero eos et accusamus et iusto odio dignissimos ducimus qui
                                                        blanditiis praesentium voluptatum deleniti atque corrupti quos
                                                        dolores et quas molestias excepturi sint occaecati cupiditate non
                                                        provident, similique sunt in culpa qui officia deserunt mollitia
                                                        animi, id est laborum</p>
                                                </div>
                                                <div class="single_capt_right">
                                                    <div
                                                        class="star-rating align-items-center d-flex justify-content-left mb-1 p-0">
                                                        <i class="fas fa-star filled"></i>
                                                        <i class="fas fa-star filled"></i>
                                                        <i class="fas fa-star filled"></i>
                                                        <i class="fas fa-star filled"></i>
                                                        <i class="fas fa-star filled"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Single Review -->
                                        <div class="single_rev d-flex align-items-start py-3">
                                            <div class="single_rev_thumb"><img src="assets/img/team-4.jpg"
                                                    class="img-fluid circle" width="90" alt="" /></div>
                                            <div class="single_rev_caption d-flex align-items-start pl-3">
                                                <div class="single_capt_left">
                                                    <h5 class="mb-0 fs-md ft-medium lh-1">Meena Rajpoot</h5>
                                                    <span class="small">17 Dec 2021</span>
                                                    <p>At vero eos et accusamus et iusto odio dignissimos ducimus qui
                                                        blanditiis praesentium voluptatum deleniti atque corrupti quos
                                                        dolores et quas molestias excepturi sint occaecati cupiditate non
                                                        provident, similique sunt in culpa qui officia deserunt mollitia
                                                        animi, id est laborum</p>
                                                </div>
                                                <div class="single_capt_right">
                                                    <div
                                                        class="star-rating align-items-center d-flex justify-content-left mb-1 p-0">
                                                        <i class="fas fa-star filled"></i>
                                                        <i class="fas fa-star filled"></i>
                                                        <i class="fas fa-star filled"></i>
                                                        <i class="fas fa-star filled"></i>
                                                        <i class="fas fa-star filled"></i>
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
            </section>
        </div>

    @endif
    <script>
        if ("{{ session('error') }}") {
            alert('{{ session('error') }}');
        }
    </script>

    <script src="{{asset('assets/js/jquery.min.js')}}"></script>
    <script src="{{asset('assets/js/popper.min.js')}}"></script>
    <script src="{{asset('assets/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('assets/js/ion.rangeslider.min.js')}}"></script>
    <script src="{{asset('assets/js/slick.js')}}"></script>
    <script src="{{asset('assets/js/slider-bg.js')}}"></script>
    <script src="{{asset('assets/js/lightbox.js')}}"></script>
    <script src="{{asset('assets/js/smoothproducts.js')}}"></script>
    <script src="{{asset('assets/js/snackbar.min.js')}}"></script>
    <script src="{{asset('assets/js/jQuery.style.switcher.js')}}"></script>
    <script src="{{asset('assets/js/custom.js')}}"></script>

</body>

</html>