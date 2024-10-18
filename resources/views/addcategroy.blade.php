@extends('layout.index')
@section("category")
<main class="w-3/4 p-8">
    <h2 class="text-3xl font-bold mb-4">Add Category</h2>
    <form class="bg-white p-6 rounded-lg shadow-lg">
        <div class="mb-4">
            <label for="categoryName" class="block text-sm font-medium text-gray-700">Category Name</label>
            <input type="text" id="categoryName" name="categoryName"
                class="mt-1 block w-full p-2 border border-gray-300 rounded-md" placeholder="Enter category name">
        </div>
        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-md">Add Category</button>
    </form>
</main>
@endsection