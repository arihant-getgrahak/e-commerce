@extends('layout.index')


@section("category")
<main class="space-y-6">

    <div>
        <h2 class="text-3xl font-bold mb-4">Add Category</h2>
        <form class="bg-white p-6 rounded-lg shadow-lg" action="{{ route('category.add') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label class="form-label required">Category Name</label>
                <select class="form-select" id="parent_id" name="parent_id">
                    <option value=""> Select Parent Category </option>
                    @foreach ($data as $category)
                        <option value="{{ $category['id'] }}">{{ $category['name'] }}</option>
                        @if (isset($category['children']))
                            @foreach ($category['children'] as $child)
                                <option value="{{ $child['id'] }}">-- {{ $child['name'] }}</option>
                            @endforeach
                        @endif
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <input type="text" class="form-control" id="name" name="name" placeholder="Enter category name">
            </div>
            <button type="submit" class="btn btn-primary ms-auto">
                Add Category
            </button>
        </form>
    </div>


    <div class="card">
        <div class="card-body">
            <h1>All Category</h1>
            <div id="table-default" class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th><button class="table-sort" data-sort="sort-name">Id</button></th>
                            <th><button class="table-sort" data-sort="sort-city">Name</button></th>
                            <!-- <th><button class="table-sort" data-sort="sort-type">Buttons</button></th> -->
                        </tr>
                    </thead>
                    <tbody class="table-tbody">
                        @foreach ($data as $key => $c)
                            <tr>
                                <td class="sort-name">{{$c["id"]}}</td>
                                <td class="sort-city">{{$c["name"]}}</td>
                                <!-- <td class="sort-type">
                                                        <button class="btn btn-primary btn-sm">Edit</button>
                                                        <button class="btn btn-danger btn-sm">Delete</button>
                                                    </td> -->
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