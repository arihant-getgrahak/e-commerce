@extends('layout.frontend')
@section("section")
@if (count($product) == 0)
    <h1>No Products</h1>
@else
    <div class="gray py-3">
        <div class="container">
            <div class="row">
                <div class="colxl-12 col-lg-12 col-md-12">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="/">Home</a></li>
                            <li class="breadcrumb-item"><a href="#">Products</a></li>
                            <li class="breadcrumb-item"><a href="#">{{$product[0]->slug}}</a>
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <div id="alert">
    </div>
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

                        @foreach ($product[0]->attributeValues as $attributeValue)
                            <div class="prt_04 mb-4">
                                <p class="d-flex align-items-center mb-0 text-dark ft-medium">
                                    {{ $attributeValue->attribute->name }}
                                </p>
                                <div class="text-left pb-0 pt-2">
                                    <div class="form-check size-option form-option form-check-inline mb-2">
                                        <input class="form-check-input" type="radio"
                                            name="attribute_{{ $attributeValue->attribute_id }}"
                                            id="attribute_{{ $attributeValue->attribute->name }}_{{ $loop->index }}" {{ $loop->first ? 'checked' : '' }}>
                                        <label class="form-option-label"
                                            for="attribute_{{ $attributeValue->attribute->name }}_{{ $loop->index }}">
                                            {{ $attributeValue->value }}
                                        </label>
                                    </div>
                                </div>
                            </div>
                        @endforeach

                        <div class="mb-4">
                            <form action="{{route("address.available")}}" method="GET">
                                <label for="pincode" class="col-form-label required">Check Availability</label>
                                <input type="text" id="pincode" name="pincode"
                                    class="mt-1 block w-full p-2 border border-gray-300 rounded-md"
                                    placeholder="Enter pincode">
                                @error("pincode")
                                    <span class="text-danger">{{$message}}</span>
                                @enderror

                                <button type="submit">Check Availability</button>
                            </form>
                            <div class="status"></div>
                        </div>


                        <div class="prt_05 mb-4">
                            <div class="form-row mb-7">
                                <div class="col-12 col-lg-auto">
                                    <!-- Quantity -->
                                    <select class="mb-2 custom-select" id="quantity">
                                        <option value="1" selected="">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                        <option value="5">5</option>
                                    </select>
                                </div>
                                <div class="col-12 col-lg">
                                    <button class="btn btn-block custom-height bg-dark mb-2"
                                        onclick="addToCart({{$product}})" id="add-to-cart">
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
                            <a class="nav-link active" id="description-tab" href="#description" data-toggle="tab" role="tab"
                                aria-controls="description" aria-selected="true">Description</a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link" href="#information" id="information-tab" data-toggle="tab" role="tab"
                                aria-controls="information" aria-selected="false">Additional
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
                        <div class="tab-pane fade" id="information" role="tabpanel" aria-labelledby="information-tab">
                            <div class="additionals">
                                <table class="table">
                                    <tbody>
                                        <tr>
                                            <th class="ft-medium text-dark">ID</th>
                                            <td>#{{$product[0]->id}}</td>
                                        </tr>
                                        <tr>
                                            <th class="ft-medium text-dark">SKU</th>
                                            <td>{{$product[0]->sku}}</td>
                                        </tr>


                                        <tr>
                                            <th class="ft-medium text-dark">Weight</th>
                                            <td>{{$product[0]->weight}}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <!-- Reviews Content -->
                        <div class="tab-pane fade" id="reviews" role="tabpanel" aria-labelledby="reviews-tab">
                            <div class="reviews_info">
                                <div class="single_rev d-flex align-items-start br-bottom py-3">
                                    <div class="single_rev_thumb"><img src="assets/img/team-1.jpg" class="img-fluid circle"
                                            width="90" alt="" /></div>
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
                                    <div class="single_rev_thumb"><img src="assets/img/team-2.jpg" class="img-fluid circle"
                                            width="90" alt="" /></div>
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
                                    <div class="single_rev_thumb"><img src="assets/img/team-3.jpg" class="img-fluid circle"
                                            width="90" alt="" /></div>
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
                                    <div class="single_rev_thumb"><img src="assets/img/team-4.jpg" class="img-fluid circle"
                                            width="90" alt="" /></div>
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

    <section class="middle pt-0">
        <div class="container">

            <div class="row justify-content-center">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                    <div class="sec_title position-relative text-center">
                        <h2 class="off_title">Similar Products</h2>
                        <h3 class="ft-bold pt-3">Matching Products</h3>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                    <div class="slide_items">

                        <!-- single Item -->
                        @foreach ($random as $r)
                            <div class="single_itesm">
                                <div class="product_grid card b-0 mb-0">
                                    <div class="badge bg-success text-white position-absolute ft-regular ab-left text-upper">
                                        Sale</div>
                                    <button class="snackbar-wishlist btn btn_love position-absolute ab-right"><i
                                            class="far fa-heart"></i></button>
                                    <div class="card-body p-0">
                                        <div class="shop_thumb position-relative">
                                            <a class="card-img-top d-block overflow-hidden" href="shop-single-v1.html"><img
                                                    class="card-img-top" src="{{$r->thumbnail}}" alt="{{$r->name}}"></a>
                                            <div
                                                class="product-hover-overlay bg-dark d-flex align-items-center justify-content-center">
                                                <div class="edlio"><a href="#" data-toggle="modal" data-target="#quickview"
                                                        class="text-white fs-sm ft-medium"><i class="fas fa-eye mr-1"></i>Quick
                                                        View</a></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-footer b-0 p-3 pb-0 d-flex align-items-start justify-content-center">
                                        <div class="text-left">
                                            <div class="text-center">
                                                <h5 class="fw-bolder fs-md mb-0 lh-1 mb-1"><a
                                                        href="shop-single-v1.html">{{$r->name}}</a></h5>
                                                <div class="elis_rty"><span
                                                        class="ft-bold fs-md text-dark">₹{{$r->price}}</span>
                                                </div>
                                            </div>
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
@endif

<script>
    const status = document.getElementsByClassName("status")[0]
    const error = "{{session('error')}}"
    const success = "{{session('success')}}"
    if (error) {
        status.innerHTML = `<p class="text-danger">${error}</p>`;
    }
    
    if (success) {
        status.innerHTML = `<p class="text-success">${success}</p>`;
    }
</script>

@endsection

@section("script")
<script>
    const session = "{{session('error')}}";
    if (session) {
        showAlert('danger', session)
        window.scrollTo(0, 0);
    }
</script>

<script>
    const arihant = document.querySelector('#alert');
    async function addToCart(productId) {
        const quantity = document.getElementById("quantity").value
        const res = await fetch("{{route("cart.add")}}", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": "{{ csrf_token() }}"
            },
            body: JSON.stringify({
                product_id: productId[0].id,
                quantity: quantity,
                price: productId[0].price
            }),
        })

        const data = await res.json()
        if (!data.status) {
            showAlert('danger', data.message)
            window.scrollTo(0, 0);
        }
        else {
            showAlert('success', data.message)
            window.scrollTo(0, 0);
        }
    }
</script>
@endsection