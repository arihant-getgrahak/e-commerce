<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://cdn.tailwindcss.com"></script>
   {{-- <link href="{{asset('assets/css/styles.css')}}" rel="stylesheet"> --}}
</head>

<body class="bg-gray-300">
<div class="preloader"></div>
    <header class="bg-white">
        <div class="container mx-auto px-6 py-3">
            <div class="flex items-center justify-between">
                <div class="w-full text-gray-700 md:text-center text-2xl font-semibold">
                    Arihant Jain
                </div>
            </div>
        </div>
    </header>
    <div class="w-[1190px] mx-auto my-auto">
        <div class="flex flex-col w-full h-auto mt-[3%]">
            @if (!$product->isEmpty())
                <div class="flex flex-wrap">
                    @foreach ($product as $p)
                        <div class="grow max-w-[20%] inline-flex px-2 pb-4 min-w-[20%]">
                            <a href={{route('product.specific', $p->slug)}}
                                class="relative bg-white inline-flex items-stretch w-full h-full p-0 box-border">
                                <div class="relative shadow-md rounded-lg min-w-full flex flex-col">
                                    <div class="relative">
                                        <div class="relative h-0 pb-[100%] w-full bg-white text-ellipsis overflow-hidden">
                                            <div
                                                class="bg-no-repeat bg-cover inline-block my-0 mx-auto text-center w-full h-full absolute">
                                                @if($p->thumbnail)
                                                    <img src="{{ $p->thumbnail }}" alt="Product Image"
                                                        class="w-full h-48 object-cover transition-transform duration-500 transform group-hover:scale-105">
                                                @else
                                                    <img src="https://via.placeholder.com/150" alt="Default Image"
                                                        class="w-full h-48 object-cover">
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="relative p-2 box-border overflow-hidden grow">
                                        <span
                                            class="text-gray-800 max-h-[38px] text-sm font-semibold leading-5 overflow-hidden whitespace-normal break-words		">
                                            {{ $p->name }}
                                        </span>
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
                            </a>
                        </div>
                    @endforeach
                </div>
            @else
                <h1>No Products</h1>
            @endif
        </div>
    </div>

</body>

</html>