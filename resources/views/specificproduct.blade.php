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

                            <div class="prt_01 mb-2"><span
                                    class="text-success bg-light-success rounded px-2 py-1">{{$product[0]->category->name}}</span>
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