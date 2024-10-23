@extends('layout.index')


@section("category")
<main class="space-y-6">

    <div>
        <h2 class="text-3xl font-bold mb-4">Add Category</h2>
        <form class="bg-white p-6 rounded-lg shadow-lg" action="{{ route('category.add') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label class="form-label required">Category Name</label>
                <input type="text" class="form-control" id="name" name="name" placeholder="Enter category name">
            </div>
            <button type="submit" class="btn btn-primary ms-auto">
                Add Category
            </button>
        </form>
    </div>

    <div>
        <h2 class="text-3xl font-bold mb-4">Add Child Category</h2>
        <form class="bg-white p-6 rounded-lg shadow-lg" action="{{ route('category.child.add') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label class="form-label">Parent Category</label>
                <div>
                    <select class="form-select" id="parent_id" name="parent_id">
                        @foreach ($data as $key => $c)
                            <option value="{{$c["id"]}}">{{$c["name"]}}</option>

                        @endforeach
                    </select>
                </div>
            </div>
            <div class="mb-3">
                <label class="form-label required">Child Category Name</label>
                <input type="text" class="form-control" id="name" name="name" placeholder="Enter category name">
            </div>
            <button type="submit" class="btn btn-primary ms-auto">
                Add Category
            </button>
        </form>
    </div>

    <div class="card">
        <div class="card-body">
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
                        @foreach ($data as $key => $c)
                            <tr>
                                <td class="sort-name">{{$c["id"]}}</td>
                                <td class="sort-city">{{$c["name"]}}</td>
                                <td class="sort-type">
                                    <button class="btn btn-primary btn-sm">Edit</button>
                                    <button class="btn btn-danger btn-sm">Delete</button>
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
    if ("{{session('success')}}") {
        alert("{{session('success')}}")
    }
</script>
@endsection