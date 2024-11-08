@extends('layout.index')


@section("attribute")
<main class="space-y-6">
    <div>
        <div>
            <h2 class="text-3xl font-bold mb-4">Add Attribute</h2>
            <form class="bg-white p-6 rounded-lg shadow-lg" action="{{route('attribute.add')}}" method="post">
                @csrf

                <div class="mb-3">
                    <input type="text" class="form-control" id="name" name="name" placeholder="Enter Attribute name">
                </div>
                <button type="submit" class="btn btn-primary ms-auto">
                    Add Attribute
                </button>
            </form>
        </div>
    </div>

    <div>
        <div>
            <h2 class="text-3xl font-bold mb-4">Add Attribute Value</h2>
            <form class="bg-white p-6 rounded-lg shadow-lg" action="{{route('attribute.value.add')}}" method="post">
                @csrf

                <div class="mb-3">
                    <label class="form-label required">Attribute Value</label>
                    <select class="form-select" id="attribute_id" name="attribute_id">
                        <option value=""> Select Attribute </option>
                        @foreach ($attributes as $attribute)
                            <option value="{{ $attribute['id'] }}">{{ $attribute['name'] }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <input type="text" class="form-control" id="value" name="value" placeholder="Enter Attribute Value">
                </div>
                <button type="submit" class="btn btn-primary ms-auto">
                    Add Attribute Value
                </button>
            </form>
        </div>
    </div>


    <!-- table -->

    <div class="card">
        <div class="card-body">
            <h1>All Attribute</h1>
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
                        @foreach ($attributes as $key => $c)
                            <tr>
                                <td class="sort-name">{{$c["id"]}}</td>
                                <td class="sort-city">{{$c["name"]}}</td>
                                <td class="sort-type">
                                    <button class="btn btn-primary btn-sm btn-update" data-bs-toggle="modal"
                                        data-bs-target="#modal-team" data-id="{{ $c["id"] }}"
                                        data-name="{{ $c["name"] }}">Edit</button>
                                    <button class="btn btn-danger btn-sm" data-bs-toggle="modal"
                                        data-bs-target="#modal-delete-{{$c['id']}}">Delete</button>
                                </td>
                            </tr>
                            <div class="modal modal-blur fade" id="modal-delete-{{$c['id']}}" tabindex="-1" role="dialog"
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
                                            <div class="text-secondary">Do you really want to delete this product? This
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
                                                        <form id="delete-form-{{$c['id']}}"
                                                            action="{{ route('attribute.delete', $c['id']) }}" method="POST"
                                                            class="w-100">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-danger w-100">Delete
                                                                attribute</button>
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

    <div class="card">
        <div class="card-body">
            <h1>All Attribute Values</h1>
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
                        @foreach ($attributes as $key => $c)
                            @foreach ($c["values"] as $value)
                                <tr>
                                    <td class="sort-name">{{$c["id"]}}</td>
                                    <td class="sort-city">
                                        {{$c["name"]}} : {{$value["value"]}}
                                    </td>
                                    <td class="sort-type">
                                        <button class="btn btn-primary btn-sm btn-update-value" data-bs-toggle="modal"
                                            data-bs-target="#modal-team-value" data-id="{{ $value["id"] }}"
                                            data-name="{{ $value["value"] }}">Edit</button>
                                        <button class="btn btn-danger btn-sm" data-bs-toggle="modal"
                                            data-bs-target="#modal-delete-{{$value['id']}}">Delete</button>
                                    </td>
                                </tr>

                                <!-- Delete Modal -->
                                <div class="modal modal-blur fade" id="modal-delete-{{$value['id']}}" tabindex="-1"
                                    role="dialog" aria-hidden="true">
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
                                                <div class="text-secondary">Do you really want to delete this attribute? This
                                                    action cannot be undone.</div>
                                            </div>
                                            <div class="modal-footer">
                                                <div class="w-100">
                                                    <div class="row">
                                                        <div class="col"><a href="#" class="btn w-100"
                                                                data-bs-dismiss="modal">Cancel</a></div>
                                                        <div class="col">
                                                            <form id="delete-form-{{$value['id']}}"
                                                                action="{{ route('attribute.value.delete', $value['id']) }}"
                                                                method="POST" class="w-100">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" class="btn btn-danger w-100">Delete
                                                                    attribute</button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @endforeach
                    </tbody>

                </table>
            </div>
        </div>
    </div>

    <!-- attribute update modal -->
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
                            <label for="name" class="col-form-label required">Attribute Name/Value</label>
                            <input type="text" id="name" name="name"
                                class="mt-1 block w-full p-2 border border-gray-300 rounded-md"
                                placeholder="Enter Attribute name">
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn me-auto" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary ms-auto">Update Attribute</button>
                </div>
                </form>
            </div>
        </div>
    </div>

    <!-- attribute value update modal -->
    <div class="modal modal-blur fade arihant" id="modal-team-value" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Update form</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="attributeValueForm" class="bg-white p-6 rounded-lg shadow-lg" method="post" action=""
                        enctype="multipart/form-data">
                        @csrf

                        <!-- Name -->
                        <div class="mb-4">
                            <label for="name" class="col-form-label required">Attribute Value</label>
                            <input type="text" id="value" name="value"
                                class="mt-1 block w-full p-2 border border-gray-300 rounded-md"
                                placeholder="Enter Attribute Value">
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn me-auto" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary ms-auto">Update Attribute Value</button>
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
                    const attributeId = this.getAttribute('data-id');
                    const name = this.getAttribute('data-name');

                    updateForm.action = "{{ route('attribute.update', ':id') }}".replace(':id', attributeId);
                    updateForm.querySelector('#name').value = name;
                });
            });
        });

    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const updateButtons = document.querySelectorAll('.btn-update-value');
            const updateForm = document.getElementById("attributeValueForm");

            updateButtons.forEach(button => {
                button.addEventListener('click', function () {
                    const attributeId = this.getAttribute('data-id');
                    const name = this.getAttribute('data-name');

                    updateForm.action = "{{ route('attribute.value.update', ':id') }}".replace(':id', attributeId);
                    updateForm.querySelector('#value').value = name;
                });
            });
        });

    </script>
</main>

@endsection