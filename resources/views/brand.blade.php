@extends('layout.index')


@section("brand")

<div>
    <h2 class="text-3xl font-bold mb-4">Add Category</h2>
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
</div>


<script>
    if ("{{session('success')}}") {
        alert("{{session('success')}}")
    }

    if ("{{session('error')}}") {
        alert("{{session('error')}}")
    }
</script>
@endsection