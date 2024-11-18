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
                            <th><button class="table-sort" data-sort="sort-name">Status</button></th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($state as $s)
                            <tr>
                                <td class="sort-id">{{ $s->id }}</td>
                                <td class="sort-name">{{ $s->name }}</td>
                                <td>
                                    @if ($s->status == 1)
                                        <span class="badge bg-success text-white">Active</span>
                                    @else
                                        <span class="badge bg-danger text-white">Inactive</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="flex items-center space-x-4">
                                        <div>
                                            <input type="radio" name="status_{{ $s->id }}" id="status-yes" value="1" {{ $s->status == 1 ? 'checked' : '' }}>
                                            <label for="status-yes-{{ $s->id }}">Yes</label>
                                        </div>
                                        <div>
                                            <input type="radio" name="status_{{ $s->id }}" id="status-no" value="0" {{ $s->status == 0 ? 'checked' : '' }}>
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

<script>
    const statusInputs = document.querySelectorAll("input[name^='status_']");

    statusInputs.forEach(input => {
        input.addEventListener("change", async () => {
            const status = input.value;
            const id = input.name.split('_')[1];
            console.log(`ID: ${id}, Status: ${status}`);
            const res = await fetch("{{route("state.update")}}",
                {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        "X-CSRF-TOKEN": "{{ csrf_token() }}",
                    },
                    body: JSON.stringify({
                        state: id,
                        status: status,
                    }),
                }
            )
            const data = await res.json();
            if(data.success){
                alert(data.message)
                window.location.reload();
            }
            else{
                alert(data.message);
            }
        });
    });
</script>

@endsection