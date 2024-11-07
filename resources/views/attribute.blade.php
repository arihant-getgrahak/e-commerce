@extends('layout.index')


@section("category")
<main class="space-y-6">
    <div>
        <div>
            <h2 class="text-3xl font-bold mb-4">Add Category</h2>
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

</main>

@endsection