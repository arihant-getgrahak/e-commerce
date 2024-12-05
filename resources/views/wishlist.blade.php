@extends("layout.myaccount")
@section("breadcrumb")
<div class="gray py-3">
    <div class="container">
        <div class="row">
            <div class="colxl-12 col-lg-12 col-md-12">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/">{{__("Home")}}</a></li>
                        <li class="breadcrumb-item"><a href="javascript:void(0);">{{__("Dashboard")}}</a></li>
                        <li class="breadcrumb-item"><a href="{{route('wishlist')}}">{{__("Wishlist")}}</a>
                        </li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>
@endsection
@section("order-display")
<div class="col-12 col-md-12 col-lg-8 col-xl-8 text-center">
    <div class="row align-items-center">
        @if(count($wishlist) == 0)
            <div class="col-xl-4 col-lg-6 col-md-6 col-sm-12">
                <h1>{{__("Wishlist is empty")}}</h1>
            </div>
        @else
            @foreach ($wishlist as $w)
                <div id="alert">
                </div>
                <div class="col-xl-4 col-lg-6 col-md-6 col-sm-12">
                    <div class="product_grid card b-0">
                        <div class="badge bg-success text-white position-absolute ft-regular ab-left text-upper">Sale</div>
                        <button class="btn btn_love position-absolute ab-right theme-cl" onclick="deleteWishlist({{ $w->id }})">
                            <i class="fas fa-times"></i>
                        </button>
                        <div class="card-body p-0">
                            <div class="shop_thumb position-relative">
                                <a class="card-img-top d-block overflow-hidden" href="shop-single-v1.html">
                                    <img class="card-img-top" src="{{ $w->product->thumbnail }}" alt="{{ $w->product->name }}">
                                </a>
                                <div class="product-hover-overlay bg-dark d-flex align-items-center justify-content-center">
                                    <div class="edlio">
                                        <a href="#" data-toggle="modal" data-target="#quickview"
                                            class="text-white fs-sm ft-medium">
                                            <i class="fas fa-eye mr-1"></i>{{__("Quick View")}}
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footers b-0 pt-3 px-2 bg-white d-flex align-items-start justify-content-center">
                            <div class="text-left">
                                <h5 class="fw-bolder fs-md mb-0 lh-1 mb-1">
                                    <a href="shop-single-v1.html">{{ $w->product->name }}</a>
                                </h5>
                                <div class="elis_rty">
                                    <span class="ft-bold fs-md text-dark">₹{{ $w->product->price }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        @endif
    </div>
</div>

<script>
    const arihant = document.querySelector('#alert');
    async function deleteWishlist(id) {
        try {
            const response = await fetch(`{{ route("wishlist.delete", ":id") }}`.replace(':id', id), {
                method: 'DELETE',
                headers: {
                    "Content-Type": "application/json",
                    'X-CSRF-Token': "{{ csrf_token() }}",
                },
            });

            const data = await response.json();
            arihant.innerHTML = `
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
        ${data.message}
                                              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
												<span aria-hidden="true">&times;</span>
											  </button>
											</div>
                                            `
            window.scrollTo(0, 0);
            if (data.status) {
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
        } catch (error) {
            arihant.innerHTML = `
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
        ${error}
                                              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
												<span aria-hidden="true">&times;</span>
											  </button>
											</div>
                                            `
            window.scrollTo(0, 0);
        }
    }
</script>
@endsection