@extends('layout.index')
@section('productadd')
<main class="w-3/4 p-8">
  <h2 class="text-3xl font-bold mb-4">Add Product</h2>
  <form class="bg-white p-6 rounded-lg shadow-lg">
    <div class="mb-4">
      <label for="productName" class="block text-sm font-medium text-gray-700">Product Name</label>
      <input type="text" id="productName" name="productName" class="mt-1 block w-full p-2 border border-gray-300 rounded-md" placeholder="Enter product name">
    </div>
    <div class="mb-4">
      <label for="price" class="block text-sm font-medium text-gray-700">Price</label>
      <input type="number" id="price" name="price" class="mt-1 block w-full p-2 border border-gray-300 rounded-md" placeholder="Enter price">
    </div>
    <div class="mb-4">
      <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
      <textarea id="description" name="description" class="mt-1 block w-full p-2 border border-gray-300 rounded-md" placeholder="Enter product description"></textarea>
    </div>
    <div class="mb-4">
      <label for="category" class="block text-sm font-medium text-gray-700">Category</label>
      <select id="category" name="category" class="mt-1 block w-full p-2 border border-gray-300 rounded-md">
        <option value="electronics">Electronics</option>
        <option value="fashion">Fashion</option>
        <option value="home">Home</option>
      </select>
    </div>
    <div class="mb-4">
      <label for="category" class="block text-sm font-medium text-gray-700">Child Category</label>
      <select id="category" name="category" class="mt-1 block w-full p-2 border border-gray-300 rounded-md">
        <option value="electronics">Electronics</option>
        <option value="fashion">Fashion</option>
        <option value="home">Home</option>
      </select>
    </div>
    <div class="mb-4">
      <label for="image" class="block text-sm font-medium text-gray-700">Product Image</label>
      <input type="file" id="image" name="image" class="mt-1 block w-full p-2 border border-gray-300 rounded-md" multiple>
    </div>
    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-md">Add Product</button>
  </form>
</main>

@endsection