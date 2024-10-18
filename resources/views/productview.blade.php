@extends('layout.index')
@section('productview')


<div class="container mx-auto p-8">
    <h1 class="text-4xl font-extrabold text-center text-gray-800 mb-10">Our Products</h1>

    @if($product->isEmpty())
        <p class="text-center text-gray-500">No products found.</p>
    @else
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-10">
            @foreach($product as $p)
                <div class="bg-white rounded-lg shadow-lg overflow-hidden hover:shadow-xl transition-shadow duration-300">
                    {{-- Product Image --}}

                    <div class="relative group">
                        <div class="flex overflow-x-scroll space-x-2 scrollbar-hide">
                            @if($p->gallery)
                                @foreach($p->gallery as $image)
                                    <img src="{{ $image->image }}" alt="Product Image"
                                        class="w-full h-48 object-cover transition-transform duration-500 transform group-hover:scale-105">
                                @endforeach
                            @else
                                <img src="https://via.placeholder.com/150" alt="Default Image" class="w-full h-48 object-cover">
                            @endif
                        </div>
                    </div>


                    <div class="p-6">
                        <h2 class="text-xl font-semibold text-gray-800 mb-3">{{ $p->name }}</h2>
                        <p class="text-gray-600 mb-4">{{ Str::limit($p->description, 100) }}</p>

                        {{-- Product Meta Information --}}
                        @if($p->meta)
                            <div class="mb-4">
                                <h3 class="text-lg font-bold text-gray-700 mb-2">Product Information</h3>
                                <ul class="space-y-1">
                                    @foreach($p->meta as $value)
                                        <li>Color: {{ $value->color }}</li>
                                        <li>Size: {{ $value->size }}</li>
                                        <li>Weight: {{ $value->weight }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        {{-- Product Brand --}}
                        @if($p->brand)
                            <p class="mb-2 text-sm"><strong>Brand:</strong> {{ $p->brand->name }}</p>
                        @endif

                        {{-- Child Products --}}
                        @if($p->children)
                            <div class="mb-4">
                                <h3 class="text-lg font-semibold mb-2">Parent Category</h3>
                                <ul class="list-disc list-inside">
                                    <li>{{ $p->parent->name }}</li>
                                </ul>
                            </div>
                        @endif

                        @if($p->children)
                            <div class="mb-4">
                                <h3 class="text-lg font-semibold mb-2">Child Category</h3>
                                <ul class="list-disc list-inside">
                                    <li>{{ $p->children->name }}</li>
                                </ul>
                            </div>
                        @endif

                        <a href="#"
                            class="block text-center bg-indigo-600 text-white font-bold py-2 rounded-md hover:bg-indigo-700 transition-colors">View
                            Product</a>
                    </div>
                </div>
            @endforeach
        </div>

        {{-- Pagination --}}
        <div class="mt-8 flex justify-center">
            {{ $product->links('pagination::tailwind') }}
        </div>
    @endif
</div>

<script>
    console.log("dd + {{ session('product') }}");
</script>

@endsection