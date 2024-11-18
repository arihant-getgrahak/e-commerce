@extends('layout.index')

@section('address')
<h1>Address</h1>

<main class="space-y-6">
    <div class="card">
        <div class="card-body">
            <h1>All Categories</h1>
            <div id="table-categories" class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th><button class="table-sort" data-sort="sort-id">ID</button></th>
                            <th><button class="table-sort" data-sort="sort-name">Name</button></th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($state as $s)
                            <tr>
                                <td class="sort-id">{{ $s->id }}</td>
                                <td class="sort-name">{{ $s->name }}</td>
                                <td>
                                    <div class="flex items-center space-x-4">
                                        <div>
                                            <input type="radio" name="status_{{ $s->id }}" id="status-yes-{{ $s->id }}"
                                                value="1" {{ $s->status == 1 ? 'checked' : '' }}>
                                            <label for="status-yes-{{ $s->id }}">Yes</label>
                                        </div>
                                        <div>
                                            <input type="radio" name="status_{{ $s->id }}" id="status-no-{{ $s->id }}"
                                                value="0" {{ $s->status == 0 ? 'checked' : '' }}>
                                            <label for="status-no-{{ $s->id }}">No</label>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</main>






{{--<div class="modal modal-blur fade" id="modal-team" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Update City</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="productForm" class="bg-white p-6 rounded-lg shadow-lg" method="post" action="">
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
                        <input type="radio" name="status" id="status-city" value="1"> Yes
                        <input type="radio" name="status" id="status-city" value="0"> No
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn me-auto" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary ms-auto">Update</button>
            </div>
            </form>
        </div>
    </div>
</div>--}}


<script>
    if ("{{ session('success') }}") {
        alert("{{ session('success') }}");
    }

    if ("{{ session('error') }}") {
        alert("{{ session('error') }}");
    }
</script>
@endsection