@extends('layout.index')


@section("brand")

<div>
    <h2 class="text-3xl font-bold mb-4">Add Brand</h2>
    <form class="bg-white p-6 rounded-lg shadow-lg" action="{{ route('brand.add') }}" method="POST"
        enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label class="form-label required">Brand Name</label>
            <input type="text" class="form-control" id="name" name="name" placeholder="Enter Brand name">
        </div>

        <div class="mb-4">
            <label for="image" class="col-form-label required">Brand Image</label>
            <input type="file" id="image" name="image" class="form-control">

        </div>
        <button type="submit" class="btn btn-primary ms-auto">
            Add Brand
        </button>
    </form>

    <div class="card">
        <div class="card-body">
            <h1>All Brand</h1>
            <div id="table-default" class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th><button class="table-sort" data-sort="sort-name">Id</button></th>
                            <th><button class="table-sort" data-sort="sort-city">Name</button></th>
                            <th><button class="table-sort" data-sort="sort-type">Buttons</button></th>
                        </tr>
                    </thead>
                    <tbody class="table-tbody">
                        @foreach ($brand as $c)
                            <tr>
                                <td class="sort-name">{{$c["id"]}}</td>
                                <td class="sort-city">{{$c["name"]}}</td>
                                <td class="sort-type">
                                    <button class="btn btn-primary btn-sm btn-update" data-bs-toggle="modal"
                                        data-bs-target="#modal-team" data-id="{{ $c["id"] }}"
                                        data-name="{{ $c["name"] }}">Edit</button>
                                    <button class="btn btn-danger btn-sm" data-bs-toggle="modal"
                                        data-bs-target="#modal-danger">Delete</button>
                                </td>
                            </tr>
                            <div class="modal modal-blur fade" id="modal-danger" tabindex="-1" role="dialog"
                                aria-hidden="true">
                                <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                        <div class="modal-status bg-danger"></div>
                                        <div class="modal-body text-center py-4">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="icon mb-2 text-danger icon-lg"
                                                width="24" height="24" viewBox="0 0 24 24" stroke-width="2"
                                                stroke="currentColor" fill="none" stroke-linecap="round"
                                                stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                <path
                                                    d="M10.24 3.957l-8.422 14.06a1.989 1.989 0 0 0 1.7 2.983h16.845a1.989 1.989 0 0 0 1.7 -2.983l-8.423 -14.06a1.989 1.989 0 0 0 -3.4 0z" />
                                                <path d="M12 9v4" />
                                                <path d="M12 17h.01" />
                                            </svg>
                                            <h3>Are you sure?</h3>
                                            <div class="text-secondary">Do you really want to delete this brand? This
                                                action cannot be
                                                undone.
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <div class="w-100">
                                                <div class="row">
                                                    <div class="col"><a href="#" class="btn w-100"
                                                            data-bs-dismiss="modal">Cancel</a></div>
                                                    <div class="col">
                                                        <form id="delete-form"
                                                            action="{{ route('brand.delete', $c['id']) }}" method="POST"
                                                            class="w-100">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-danger w-100">Delete
                                                                product</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach

                    </tbody>
                </table>
            </div>
        </div>
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
                            <label for="name" class="col-form-label required">Brand Name</label>
                            <input type="text" id="name" name="name"
                                class="mt-1 block w-full p-2 border border-gray-300 rounded-md"
                                placeholder="Enter product name">
                        </div>

                        <!-- Image -->
                        <div class="mb-4">
                            <label for="image" class="col-form-label required">Brand Image</label>
                            <input type="file" id="image" name="image" class="form-control">
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
</div>


<script>
    if ("{{session('success')}}") {
        alert("{{session('success')}}")
    }

    if ("{{session('error')}}") {
        alert("{{session('error')}}")
    }

    document.addEventListener('DOMContentLoaded', function () {
        const updateButtons = document.querySelectorAll('.btn-update');
        const updateForm = document.getElementById("productForm");

        updateButtons.forEach(button => {
            button.addEventListener('click', function () {
                const productId = this.getAttribute('data-id');
                const name = this.getAttribute('data-name');


                updateForm.action = "{{ route('brand.update', ':id') }}".replace(':id', productId);
                updateForm.querySelector('#name').value = name;
            });
        });
    });
</script>
@endsection