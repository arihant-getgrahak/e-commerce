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
                    <select class="form-select">
                        @foreach ($category as $c)
                        <option value="{{$c->id}}">{{$c->name}}</option>

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
</main>
<script>
    if ("{{session('success')}}") {
        alert("{{session('success')}}")
    }
</script>
@endsection