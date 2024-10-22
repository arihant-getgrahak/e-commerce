<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Specific Product</title>
    <!-- <script src="https://cdn.tailwindcss.com"></script> -->

    <link rel="stylesheet" href="{{asset('dist/css/tabler.min.css')}}">
    <link rel="stylesheet" href="{{asset('dist/css/tabler-flags.min.css')}}">
    <link rel="stylesheet" href="{{asset('dist/css/tabler-payments.min.css')}}">
    <link rel="stylesheet" href="{{asset('dist/css/tabler-vendors.min.css')}}">
    <link rel="stylesheet" href="{{asset('dist/css/demo.min.css')}}">

    <style>
        @import url('https://rsms.me/inter/inter.css');

        :root {
            --tblr-font-sans-serif: 'Inter Var', -apple-system, BlinkMacSystemFont, San Francisco, Segoe UI, Roboto, Helvetica Neue, sans-serif;
        }

        body {
            font-feature-settings: "cv03", "cv04", "cv11";
        }
    </style>
</head>

<body>
    <main>
        <section>
            <div class="bg-white">
                <header>
                    <div class="container mx-auto px-6 py-3">
                        <div class="flex items-center justify-between">
                            <div class="w-full text-gray-700 md:text-center text-2xl font-semibold">
                                Arihant Jain
                            </div>
                        </div>
                    </div>
                </header>

                @if (count($product) == 0)
                    <h1>No Products</h1>
                @else
                    <main class="my-8">
                        <div class="container mx-auto px-6">
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="card">
                                        <div class="card-header">
                                            <h3 class="card-title">Product Images</h3>
                                        </div>
                                        <div class="card-body">
                                            <div id="carousel-indicators" class="carousel slide" data-bs-ride="carousel">
                                                <div class="carousel-indicators">
                                                    @foreach ($product[0]->gallery as $index => $image)
                                                        <button type="button" data-bs-target="#carousel-indicators"
                                                            data-bs-slide-to="{{ $index }}"
                                                            class="{{ $loop->first ? 'active' : '' }}"
                                                            aria-current="{{ $loop->first ? 'true' : 'false' }}"
                                                            aria-label="Slide {{ $index + 1 }}"></button>
                                                    @endforeach
                                                </div>
                                                <div class="carousel-inner">
                                                    @foreach ($product[0]->gallery as $index => $image)
                                                        <div class="carousel-item {{ $loop->first ? 'active' : '' }}">
                                                            <img class="d-block w-100" src="{{ $image->image }}"
                                                                alt="Product Image {{ $index + 1 }}">
                                                        </div>
                                                    @endforeach
                                                </div>
                                                <button class="carousel-control-prev" type="button"
                                                    data-bs-target="#carousel-indicators" data-bs-slide="prev">
                                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                                    <span class="visually-hidden">Previous</span>
                                                </button>
                                                <button class="carousel-control-next" type="button"
                                                    data-bs-target="#carousel-indicators" data-bs-slide="next">
                                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                                    <span class="visually-hidden">Next</span>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="w-full max-w-lg mx-auto mt-5 md:ml-8 md:mt-0 md:w-1/2">
                                    <h3 class="text-gray-700 uppercase text-lg">{{$product[0]->name}}</h3>
                                    <h3 class="text-gray-500 uppercase text-sm mt-3 mb-3">{{$product[0]->description}}</h3>
                                    <span class="text-black mt-3">₹{{$product[0]->price}}</span>

                                    <div class="flex items-center mt-6">
                                        <button class="btn btn-primary">Order
                                            Now</button>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </main>
                @endif

                <footer class="bg-gray-200">
                    <div class="container mx-auto px-6 py-3 flex justify-between items-center">
                        <a href="#" class="text-xl font-bold text-gray-500 hover:text-gray-400">Brand</a>
                        <p class="py-2 text-gray-500 sm:py-0">All rights reserved</p>
                    </div>
                </footer>
            </div>
        </section>
    </main>
    <script>
        if ("{{ session('error') }}") {
            alert('{{ session('error') }}');
        }
    </script>

    <script src="{{asset('dist/libs/nouislider/dist/nouislider.min.js')}}" defer></script>
    <script src="{{asset('dist/libs/litepicker/dist/litepicker.js')}}" defer></script>
    <script src="{{asset('dist/libs/tom-select/dist/js/tom-select.base.min.js')}}" defer></script>
    <script src="{{asset('dist/js/tabler.min.js')}}" defer></script>
    <script src="{{asset('dist/js/demo.min.js')}}" defer></script>
</body>

</html>