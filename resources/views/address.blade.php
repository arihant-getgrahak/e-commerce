@extends("layout.myaccount")
@section("breadcrumb")

<div class="gray py-3">
    <div class="container">
        <div class="row">
            <div class="colxl-12 col-lg-12 col-md-12">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/">Home</a></li>
                        <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{route('address')}}">Address</a>
                        </li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>
@endsection

@section("address")
<div class="col-12 col-md-12 col-lg-8 col-xl-8">
    <div class="row align-items-start">
        @foreach ($address as $addres)
            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                <div class="card-wrap border rounded mb-4">
                    <div class="card-wrap-header px-3 py-2 br-bottom d-flex align-items-center justify-content-between">
                        <div class="card-header-flex">
                            <h4 class="fs-md ft-bold mb-1">{{__("Shipping Address")}}</h4>

                        </div>
                    </div>
                    <div class="card-wrap-body px-3 py-3">
                        <h5 class="ft-medium mb-1">{{$addres->name}}</h5>
                        <p>{{$addres->address}}, {{$addres->city}}, {{$addres->state}},
                            {{$addres->pincode}},<br>{{$addres->country}}</p>
                        <p class="lh-1"><span class="text-dark ft-medium">{{__("Email")}}:</span> {{$addres->email}}</p>
                        <p><span class="text-dark ft-medium">{{__("Phone Number")}}:</span> +91 {{$addres->phone}}</p>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection