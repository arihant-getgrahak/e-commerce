@extends('layout.index')

@section('address')
<h1>Address</h1>

<main class="space-y-6">
    <div class="card">
        <div class="card-body">
            <h1>All States</h1>
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


<script>
    if ("{{ session('success') }}") {
        alert("{{ session('success') }}");
    }

    if ("{{ session('error') }}") {
        alert("{{ session('error') }}");
    }
</script>
@endsection