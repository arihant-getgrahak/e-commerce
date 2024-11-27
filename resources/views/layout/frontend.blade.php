<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="{{asset('assets/css/styles.css')}}" rel="stylesheet">
    <meta name="_token" content="{{ csrf_token() }}">
    @yield("css")
    <style>
        .text-red-500 {
            color: red;
        }

        .underline {
            text-decoration: underline;
        }
    </style>
</head>

<body>
    <div class="preloader"></div>
    <div id="main-wrapper">

        <!-- Start Navigation -->
        @include('header')
        <!-- End Navigation -->

        <div class="clearfix"></div>
        <div id="alert"></div>

        @yield('section')


        <!-- Start Footer -->
        @include('footer')
        <!-- End Footer -->

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

                        <form action="{{ route('login.post') }}" method="post" autocomplete="off">
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
                                <p class="extra">Not a member?<a href="{{route('register')}}" class="text-dark">
                                        Register</a></p>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Modal -->

        <!-- Cart Modal -->
        <div class="w3-ch-sideBar w3-bar-block w3-card-2 w3-animate-right" style="display:none;right:0;" id="Cart">
            <div class="rightMenu-scroll">
                <div class="d-flex align-items-center justify-content-between slide-head py-3 px-3">
                    <h4 class="cart_heading fs-md ft-medium mb-0">Products List</h4>
                    <button onclick="closeCart()" class="close_slide"><i class="ti-close"></i></button>
                </div>
                <div class="right-ch-sideBar">
                    <div class="cart_select_items py-2" id="cart">
                    </div>
                    <div class="d-flex align-items-center justify-content-between br-top br-bottom px-3 py-3">
                        <h6 class="mb-0">Subtotal</h6>
                        <h3 class="mb-0 ft-medium" id="subtotal">₹0</h3>
                    </div>
                    <div class="cart_action px-3 py-3">
                        <div class="form-group">
                            <a href="{{ route('checkout') }}" class="btn d-block full-width btn-dark">
                                Checkout Now
                            </a>
                        </div>
                        <div class="form-group">
                            <a href="{{route('cart')}}" class="btn d-block full-width btn-dark-light">
                                Edit or View
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Wishlist Modal -->
        <div class="w3-ch-sideBar w3-bar-block w3-card-2 w3-animate-right" style="display:none;right:0;" id="Wishlist">
            <div class="rightMenu-scroll">
                <div class="d-flex align-items-center justify-content-between slide-head py-3 px-3">
                    <h4 class="cart_heading fs-md ft-medium mb-0">Saved Products</h4>
                    <button onclick="closeWishlist()" class="close_slide"><i class="ti-close"></i></button>
                </div>
                <div class="right-ch-sideBar">
                    <div class="cart_select_items py-2" id="wishlistmodal">
                        <!-- Single Item -->

                    </div>

                    <div class="d-flex align-items-center justify-content-between br-top br-bottom px-3 py-3">
                        <h6 class="mb-0">Subtotal</h6>
                        <h3 class="mb-0 ft-medium" id="wishlistsubtotal">₹0</h3>
                    </div>

                    <div class="cart_action px-3 py-3">
                        <div class="form-group">
                            <button type="button" class="btn d-block full-width btn-dark">Move To Cart</button>
                        </div>
                        <div class="form-group">
                            <button type="button" class="btn d-block full-width btn-dark-light">Edit or View</button>
                            i
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <!-- Search -->
        <div class="w3-ch-sideBar w3-bar-block w3-card-2 w3-animate-right" style="display:none; right:0;" id="Search">
            <div class="rightMenu-scroll">
                <div class="d-flex align-items-center justify-content-between slide-head py-3 px-3">
                    <h4 class="cart_heading fs-md ft-medium mb-0">Search Products</h4>
                    <button onclick="closeSearch()" class="close_slide"><i class="ti-close"></i></button>
                </div>

                <div class="cart_action px-3 py-4">
                    <form class="form m-0 p-0" action="{{ route('search') }}" method="GET" id="searchform">
                        @csrf
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="Product Keyword.." name="search"
                                id="search" />
                            @error("search")
                                <p>{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- <div class="form-group">
                    <select class="custom-select">
                        <option value="1" selected>Choose Category</option>
                        <option value="2">Men's Store</option>
                        <option value="3">Women's Store</option>
                        <option value="4">Kid's Fashion</option>
                        <option value="5">Inner Wear</option>
                    </select>
                </div> -->

                        <div class="form-group mb-0">
                            <button type="submit" class="btn d-block full-width btn-dark">Search Product</button>
                        </div>
                    </form>
                </div>

                <!-- Recent Searches -->
                <div class="cart_action px-3 py-4 d-flex flex-column">

                    @if(session('recentsearch'))
                        <h1>Recent Searches</h1>
                        @foreach(session('recentsearch') as $search)
                            <div class="d-flex align-items-center justify-content-between py-3 px-3"
                                style="gap:10px;!important; border-bottom: 1px solid black;">
                                <p>{{ $search->search_keyword }}</p>
                                <p>Count: {{ $search->count }}</p>
                            </div>
                        @endforeach
                    @endif
                </div>

                <!-- Dynamic product list -->
                <div class="cart_action px-3 py-4 d-flex flex-column">
                    @if(session('search') && !empty(session('search')))
                        <h1>Search Results</h1>
                        @foreach(session('search') as $product)
                            <a href="{{ route('product.specific', $product->slug) }}">
                                <div class="d-flex align-items-center mb-4" style="gap:10px;">
                                    <img style="width:50px;" src="{{ $product->thumbnail }}" alt="{{ $product->name }}">
                                    <p>{{ $product->name }}</p>
                                </div>
                            </a>
                        @endforeach
                    @else
                    @endif
                </div>

            </div>
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


        <script>
            function openCart() {
                document.getElementById("Cart").style.display = "block";
            }
            function closeCart() {
                document.getElementById("Cart").style.display = "none";
            }
        </script>

        <script>
            function openWishlist() {
                document.getElementById("Wishlist").style.display = "block";
            }
            function closeWishlist() {
                document.getElementById("Wishlist").style.display = "none";
            }
        </script>

        <script>
            function openSearch() {
                document.getElementById("Search").style.display = "block";
            }
            function closeSearch() {
                document.getElementById("Search").style.display = "none";
            }
        </script>


        <script>
            document.addEventListener('DOMContentLoaded', async function () {
                const res = await fetch("{{route("cartcount")}}", {
                    method: "GET",
                    headers: {
                        "Content-Type": "application/json",
                        "X-CSRF-TOKEN": "{{ csrf_token() }}"
                    },
                })
                const data = await res.json();

                document.getElementById("cart-count").innerText = data.cart.length;
                document.getElementById("subtotal").innerText = "₹" + data.price;
                const cartcontainer = document.getElementById("cart");
                cartcontainer.innerHTML = '';

                data.cart.forEach(function (product) {
                    const cartHtml = `
                            <div class="d-flex align-items-center justify-content-between br-bottom px-3 py-3">
								<div class="cart_single d-flex align-items-center">
									<div class="cart_selected_single_thumb">
										<a href="#"><img src="${product.products[0].thumbnail}" width="60" class="img-fluid" alt=${product.products[0].name} /></a>
									</div>
									<div class="cart_single_caption pl-2">
										<h4 class="product_title fs-sm ft-medium mb-0 lh-1">${product.products[0].name}</h4>
										<h4 class="fs-md ft-medium mb-0 lh-1">₹${product.products[0].price}</h4>
									</div>
								</div>
								<div class="fls_last"><button class="close_slide gray" onclick="removeCart(${product.id})"><i class="ti-close"></i></button></div>
							</div>`;
                    cartcontainer.insertAdjacentHTML('beforeend', cartHtml);
                });

            });
        </script>

        <script>
            document.addEventListener('DOMContentLoaded', async function () {
                const res = await fetch("{{route("wishlist.count")}}", {
                    method: "GET",
                    headers: {
                        "Content-Type": "application/json",
                        "X-CSRF-TOKEN": "{{ csrf_token() }}"
                    },
                })
                const data = await res.json();

                document.getElementById("wishlist-count").innerText = data.wishlist.length;
                document.getElementById("wishlistsubtotal").innerText = "₹" + data.price;
                const wishlistcontainer = document.getElementById("wishlistmodal");
                wishlistcontainer.innerHTML = '';

                data.wishlist.forEach(function (product) {
                    const cartHtml = `<div class="d-flex align-items-center justify-content-between br-bottom px-3 py-3">
                            <div class="cart_single d-flex align-items-center">
                                <div class="cart_selected_single_thumb">
                                    <a href="#"><img src="${product.product.thumbnail}" width="60" class="img-fluid"
                                            alt="${product.product.name}" /></a>
                                </div>
                                <div class="cart_single_caption pl-2">
                                    <h4 class="product_title fs-sm ft-medium mb-0 lh-1">${product.product.name}</h4>
                                    <p class="mb-2"><span class="text-dark ft-medium small">36</span>, <span
                                            class="text-dark small">Red</span></p>
                                    <h4 class="fs-md ft-medium mb-0 lh-1">₹${product.product.price}</h4>
                                </div>
                            </div>
                            <div class="fls_last"><button class="close_slide gray" onclick="removeWishlist(${product.id})"><i class="ti-close"></i></button>
                            </div>
                        </div> `;
                    wishlistcontainer.insertAdjacentHTML('beforeend', cartHtml);
                });
            });
        </script>

        <script>
            async function removeWishlist(id) {
                const res = await fetch("{{route("wishlist.delete", ":id")}}".replace(':id', id), {
                    method: 'DELETE',
                    headers: {
                        "Content-Type": "application/json",
                        'X-CSRF-Token': "{{ csrf_token() }}",
                    },
                })

                const data = await res.json();

                if (!data.status) {
                    showAlert('danger', data.message)
                    window.scrollTo(0, 0);
                }
                else {
                    showAlert('success', data.message)
                    window.location.reload();
                }
            }
        </script>

        <script>
            async function removeCart(id) {
                const res = await fetch("{{route('cart.delete', ':id')}}".replace(":id", id), {
                    method: "DELETE",
                    headers: {
                        "Content-Type": "application/json",
                        "X-CSRF-TOKEN": "{{ csrf_token() }}"
                    },
                });
                const data = await res.json();
                if (!data.status) {
                    showAlert('danger', data.message)
                    window.scrollTo(0, 0);

                } else {
                    showAlert('success', data.message)
                    window.location.reload();
                }
            }
        </script>

        <script>
            function showAlert(type, message) {
                arihant.innerHTML = `
            <div class="alert alert-${type} alert-dismissible fade show" role="alert">
                ${message}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        `;
            }
        </script>

        <script>
            document.addEventListener('DOMContentLoaded', function () {
                @if(session('search') && session('search')->isNotEmpty())
                    document.getElementById('Search').style.display = 'block';
                @endif
            });
        </script>

        @yield('script')
</body>

</html>