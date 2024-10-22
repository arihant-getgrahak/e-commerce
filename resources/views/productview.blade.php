@extends('layout.index')
@section('productview')


<div class="container ">
    <h1 class="text-4xl font-extrabold text-center text-gray-800 mb-10">Products</h1>

    @if($product->isEmpty())
        <p class="text-center text-gray-500">No products found.</p>
    @else
        <div class="row">
            @foreach ($product as $p)
                <div class="col-md-6 col-lg-3">
                    <div class="card">
                        <!-- Photo -->
                        <div class="img-responsive img-responsive-21x9 card-img-top"
                            style='background-image: url({{ $p->gallery[0]->image }})'>
                        </div>
                        <div class="card-body">
                            <h3 class="card-title">{{ $p->name }}</h3>
                            <p class="text-secondary">{{ $p->description }}</p>

                            <div>
                                <div class="block w-full text-sm font-bold text-amber-700">
                                    ₹{{ $p->price }}
                                </div>
                            </div>

                            <div>
                                <div class="flex align-items-center text-xs leading-6 mx-0 my-1 text-gray-600">
                                    Category: {{ $p->category->name }}
                                </div>
                            </div>
                            <div class="flex align-items-center text-xs leading-6 mx-0 my-1 text-gray-600">
                                Brand: {{ $p->brand->name }}
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>

@endsection