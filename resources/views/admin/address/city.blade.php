@extends('layout.index')

@section('address')
<div class="d-flex justify-content-between mb-4">
    <h1>Address</h1>
    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#cityModal">Add</button>
</div>

<main class="space-y-6">
    <div class="card">
        <div class="card-body">
            <h1>All City</h1>
            <div id="table-categories" class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th><button class="table-sort">ID</button></th>
                            <th><button class="table-sort">Name</button></th>
                            <th><button class="table-sort">State</button></th>
                            <th><button class="table-sort">Status</button></th>
                            <th>Buttons</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($city as $s)
                            <tr>
                                <td class="sort-id">{{ $s->id }}</td>
                                <td class="sort-name">{{ $s->name }}</td>
                                <td class="sort-name">{{ $s->state->name }}</td>
                                <td>
                                    @if ($s->status == 1)
                                        <span class="badge bg-success text-white">Active</span>
                                    @else
                                        <span class="badge bg-danger text-white">Inactive</span>
                                    @endif
                                </td>
                                <td>
                                    <button class="btn btn-primary btn-sm btn-update" id="btn-update" data-bs-toggle="modal"
                                        data-bs-target="#modal-city-update" data-id="{{ $s->id }}"
                                        data-name="{{ $s->name }}" data-status="{{ $s->status }}">Edit</button>
                                    <button class="btn btn-danger btn-sm" data-bs-toggle="modal"
                                        data-bs-target="#modal-delete-{{$s->id}}">Delete</button>
                                </td>
                            </tr>
                            <!-- Delete Modal -->
                            <div class="modal modal-blur fade" id="modal-delete-{{$s->id}}" tabindex="-1" role="dialog"
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
                                                action cannot be undone.</div>
                                        </div>
                                        <div class="modal-footer">
                                            <div class="w-100">
                                                <div class="row">
                                                    <div class="col"><a href="#" class="btn w-100"
                                                            data-bs-dismiss="modal">Cancel</a></div>
                                                    <div class="col">
                                                        <form id="delete-form-{{$s->id}}"
                                                            action="{{ route('city.delete', $s->id) }}" method="POST"
                                                            class="w-100">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-danger w-100">Delete
                                                                City</button>
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
</main>

<!-- Add City Modal -->
<div class="modal modal-blur fade" id="cityModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add New City</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="cityForm" class="bg-white p-6 rounded-lg shadow-lg" method="post"
                    action="{{route("city.add")}}">
                    @csrf
                    <!-- Name -->
                    <div class="mb-4">
                        <label for="name" class="col-form-label required">City Name</label>
                        <input type="text" id="name" name="name"
                            class="mt-1 block w-full p-2 border border-gray-300 rounded-md"
                            placeholder="Enter product name">
                    </div>
                    <div class="mb-4">
                        <label class="form-label required">State Name</label>
                        <select class="form-select" id="state_id" name="state_id" required>
                        </select>
                        @error('state_id')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-4">
                        <label class="form-label required">Country Name</label>
                        <select class="form-select" id="country" name="country" required>
                            @foreach ($country as $c)
                                <option value="{{ $c->id }}">{{ $c->name }}</option>
                            @endforeach
                        </select>
                        @error('country')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mt-3">
                        <label class="form-label required">IsActive</label>
                        <input type="radio" name="status" id="status-city" value="1"> Yes
                        <input type="radio" name="status" id="status-city" value="0"> No
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn me-auto" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary ms-auto">Add</button>
            </div>
            </form>
        </div>
    </div>
</div>

<!-- Update City Modal -->
<div class="modal modal-blur fade" id="modal-city-update" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Update City</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="cityUpdateForm" class="bg-white p-6 rounded-lg shadow-lg" method="post" action="">
                    @csrf
                    <!-- Name -->
                    <div class="mb-4">
                        <label for="name" class="col-form-label required">City Name</label>
                        <input type="text" id="name" name="name"
                            class="mt-1 block w-full p-2 border border-gray-300 rounded-md"
                            placeholder="Enter product name">
                    </div>
                    <div class="mt-3">
                        <label class="form-label required">IsActive</label>
                        <input type="radio" name="status" id="status" value="1"> Yes
                        <input type="radio" name="status" id="status" value="0"> No
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn me-auto" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary ms-auto">Update</button>
            </div>
            </form>
        </div>
    </div>
</div>

@include('layout.pagination', ['paginator' => $city])

<script>
    if ("{{ session('success') }}") {
        alert("{{ session('success') }}");
    }

    if ("{{ session('error') }}") {
        alert("{{ session('error') }}");
    }
</script>

<script>
    document.addEventListener('DOMContentLoaded', async function () {
        const country = document.getElementById('country');
        const state = document.getElementById('state_id');

        const res = await fetch("{{route("admin.state.list", ":id")}}".replace(':id', country.value), {
            method: 'GET',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            }
        });

        const data = await res.json();

        state.innerHTML = '';
        state.innerHTML += '<option value="">Select State</option>';

        data.forEach(option => {
            const HTML = `<option value="${option.id}">${option.name}</option>`;
            state.innerHTML += HTML;
        });
    })
</script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const updateButtons = document.querySelectorAll('.btn-update');
        const updateForm = document.getElementById("cityUpdateForm");

        updateButtons.forEach(button => {
            button.addEventListener('click', function () {
                const id = this.getAttribute('data-id');
                const name = this.getAttribute('data-name');
                const status = this.getAttribute('data-status');
                const statusBool = Boolean(status);


                // updateForm.action = "{{ route('category.update', ':id') }}".replace(':id', productId);

                updateForm.querySelector('#name').value = name;
                if (statusBool) {
                    document.querySelector('input[id="status"][value="1"]').checked = true;
                } else {
                    document.querySelector('input[id="status"][value="0"]').checked = true;
                }
            });
        });
    });

</script>
@endsection