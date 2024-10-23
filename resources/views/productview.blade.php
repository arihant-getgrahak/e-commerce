@extends('layout.index')
@section('productview')

<div class="container">
    <h1 class="text-4xl font-extrabold text-center text-gray-800 mb-10">Products</h1>

    @if(!count($product))
        <p class="text-center text-gray-500">No products found.</p>
    @else
        <div class="row">
            @foreach ($product as $p)
                <div class="col-md-5 col-lg-4 mb-3">
                    <div class="card">
                        <!-- Photo -->
                        <div class="img-responsive img-responsive-21x9 card-img-top"
                            style='background-image: url({{ $p->thumbnail }})'>
                        </div>
                        <div class="card-body">
                            <div>
                                <h3 class="card-title">{{ $p->name }}</h3>
                                <p class="text-secondary">{{ $p->description }}</p>
                            </div>

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
                            <div class="flex gap-5 mt-3">

                                <button class="btn btn-primary btn-update" data-bs-toggle="modal" data-bs-target="#modal-team"
                                    data-id="{{ $p->id }}" data-name="{{ $p->name }}" data-description="{{ $p->description }}"
                                    data-price="{{ $p->price }}" data-stock="{{ $p->stock }}" data-sku="{{ $p->meta[0]->sku }}"
                                    data-weight="{{ $p->meta[0]->weight }}">
                                    Update Product
                                </button>
                                <button class="btn btn-danger btn-delete" data-bs-toggle="modal" data-bs-target="#modal-danger"
                                    data-id="{{ $p->id }}">Delete Product</button>

                            </div>
                        </div>
                    </div>
                </div>
                <!-- delete modal -->
                <div class="modal modal-blur fade" id="modal-danger" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            <div class="modal-status bg-danger"></div>
                            <div class="modal-body text-center py-4">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon mb-2 text-danger icon-lg" width="24"
                                    height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                    stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <path
                                        d="M10.24 3.957l-8.422 14.06a1.989 1.989 0 0 0 1.7 2.983h16.845a1.989 1.989 0 0 0 1.7 -2.983l-8.423 -14.06a1.989 1.989 0 0 0 -3.4 0z" />
                                    <path d="M12 9v4" />
                                    <path d="M12 17h.01" />
                                </svg>
                                <h3>Are you sure?</h3>
                                <div class="text-secondary">Do you really want to delete this product? This action cannot be
                                    undone.
                                </div>
                            </div>
                            <div class="modal-footer">
                                <div class="w-100">
                                    <div class="row">
                                        <div class="col"><a href="#" class="btn w-100" data-bs-dismiss="modal">Cancel</a></div>
                                        <div class="col">
                                            <form id="delete-form" action="{{ route('product.delete', $p->id) }}" method="POST"
                                                class="w-100">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger w-100">Delete product</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>

<!-- update modal -->
<div class="modal modal-blur fade" id="modal-team" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Update form</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="productForm" class="bg-white p-6 rounded-lg shadow-lg" method="post" action=""
                    enctype="multipart/form-data">
                    @csrf

                    <!-- Name -->
                    <div class="mb-4">
                        <label for="name" class="col-form-label required">Product Name</label>
                        <input type="text" id="name" name="name"
                            class="mt-1 block w-full p-2 border border-gray-300 rounded-md"
                            placeholder="Enter product name">
                        @error('name')
                            <p class="text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Description -->
                    <div class="mb-4">
                        <label for="description" class="col-form-label required">Description</label>
                        <textarea id="description" name="description"
                            class="mt-1 block w-full p-2 border border-gray-300 rounded-md"
                            placeholder="Enter product description"></textarea>
                        @error('description')
                            <p class="text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Price -->
                    <div class="mb-4">
                        <label for="price" class="col-form-label required">Price</label>
                        <input type="text" id="price" name="price"
                            class="mt-1 block w-full p-2 border border-gray-300 rounded-md" placeholder="Enter price">
                        @error('price')
                            <p class="text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Stock -->
                    <div class="mb-4">
                        <label for="stock" class="col-form-label required">Stock</label>
                        <input type="number" id="stock" name="stock"
                            class="mt-1 block w-full p-2 border border-gray-300 rounded-md"
                            placeholder="Enter stock quantity">
                        @error('stock')
                            <p class="text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Sku -->
                    <div class="mb-4">
                        <label for="sku" class="col-form-label required">SKU</label>
                        <input type="text" id="sku" name="sku"
                            class="mt-1 block w-full p-2 border border-gray-300 rounded-md"
                            placeholder="Enter product SKU">
                        @error('sku')
                            <p class="text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Weight -->
                    <div class="mb-4">
                        <label for="weight" class="col-form-label required">Weight</label>
                        <input type="text" id="weight" name="weight"
                            class="mt-1 block w-full p-2 border border-gray-300 rounded-md"
                            placeholder="Enter product weight">
                        @error('weight')
                            <p class="text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn me-auto" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary ms-auto">Update Product</button>
            </div>
            </form>
        </div>
    </div>
</div>


<script>
    document.addEventListener('DOMContentLoaded', function () {
        const updateButtons = document.querySelectorAll('.btn-update');
        const updateForm = document.getElementById("productForm");

        updateButtons.forEach(button => {
            button.addEventListener('click', function () {
                const productId = this.getAttribute('data-id');
                const name = this.getAttribute('data-name');
                const description = this.getAttribute('data-description');
                const price = this.getAttribute('data-price');
                const stock = this.getAttribute('data-stock');
                const sku = this.getAttribute('data-sku');
                const weight = this.getAttribute('data-weight');

                updateForm.action = "{{ route('product.update', ':id') }}".replace(':id', productId);
                updateForm.querySelector('#name').value = name;
                updateForm.querySelector('#description').value = description;
                updateForm.querySelector('#price').value = price;
                updateForm.querySelector('#stock').value = stock;
                updateForm.querySelector('#sku').value = sku;
                updateForm.querySelector('#weight').value = weight;
            });
        });
    });
</script>
@endsection