@extends('layout.index')

@section('address')
<h1>Address</h1>

<main class="space-y-6">
    <div class="card">
        <div class="card-body">
            <h1>All Country</h1>
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
                        @foreach ($country as $c)
                            <tr>
                                <td class="sort-name">{{$c->id}}</td>
                                <td class="sort-city">{{$c->name}}</td>
                                <td class="sort-type">
                                    <input type="radio" name="status" id="status-yes" value="1" {{ $c->status == 1 ? 'checked' : '' }}>
                                    <label for="status-yes">Yes</label>
                                    <input type="radio" name="status" id="status-no" value="0" {{ $c->status == 0 ? 'checked' : '' }}>
                                    <label for="status-no">No</label>
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