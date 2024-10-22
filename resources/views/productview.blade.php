@extends('layout.index')
@section('productview')

<div class="container">
    <h1 class="text-4xl font-extrabold text-center text-gray-800 mb-10">Products</h1>

    @if($product->isEmpty())
        <p class="text-center text-gray-500">No products found.</p>
    @else
        <div class="row">
            @foreach ($product as $p)
                <div class="col-md-6 col-lg-4">
                    <div class="card">
                        <!-- Photo -->
                        <div class="img-responsive img-responsive-21x9 card-img-top"
                            style='background-image: url({{ $p->gallery[0]->image }})'>
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
                                <a class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modal-team" href="#">Update
                                    Product</a>
                                <a class="btn btn-danger btn-delete" data-bs-toggle="modal" data-bs-target="#modal-danger"
                                    data-id="{{ $p->id }}" href="#">Delete Product</a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif

    <!-- delete modal -->
    <div class="modal modal-blur fade" id="modal-danger" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
            <div class="modal-content">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                <div class="modal-status bg-danger"></div>
                <div class="modal-body text-center py-4">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon mb-2 text-danger icon-lg" width="24" height="24"
                        viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
                        stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <path
                            d="M10.24 3.957l-8.422 14.06a1.989 1.989 0 0 0 1.7 2.983h16.845a1.989 1.989 0 0 0 1.7 -2.983l-8.423 -14.06a1.989 1.989 0 0 0 -3.4 0z" />
                        <path d="M12 9v4" />
                        <path d="M12 17h.01" />
                    </svg>
                    <h3>Are you sure?</h3>
                    <div class="text-secondary">Do you really want to delete this product? This action cannot be undone.
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="w-100">
                        <div class="row">
                            <div class="col"><a href="#" class="btn w-100" data-bs-dismiss="modal">Cancel</a></div>
                            <div class="col">
                                <form id="delete-form" action="#" method="POST" class="w-100">
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
</div>


<script>
    document.addEventListener('DOMContentLoaded', function () {
        const deleteButtons = document.querySelectorAll('.btn-delete');
        const deleteForm = document.getElementById('delete-form');

        deleteButtons.forEach(button => {
            button.addEventListener('click', function () {
                const productId = this.getAttribute('data-id');
                deleteForm.action = `/product/delete/${productId}`;
            });
        });
    });
</script>
@endsection