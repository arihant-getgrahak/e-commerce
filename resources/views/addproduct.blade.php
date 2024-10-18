@extends('layout.index')
@section('productadd')
<main class="w-3/4 p-8">
  <h2 class="text-3xl font-bold mb-4">Add Product</h2>
  <form class="bg-white p-6 rounded-lg shadow-lg" action="{{ route('product.add') }}" method="POST"
    enctype="multipart/form-data">
    @csrf

    <!-- Name -->
    <div class="mb-4">
      <label for="name" class="block text-sm font-medium text-gray-700">Product Name</label>
      <input type="text" id="name" name="name" class="mt-1 block w-full p-2 border border-gray-300 rounded-md"
        placeholder="Enter product name">
      @error('name')
      <span class="text-red-500 text-sm">{{ $message }}</span>
    @enderror
    </div>

    <!-- Description -->
    <div class="mb-4">
      <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
      <textarea id="description" name="description" class="mt-1 block w-full p-2 border border-gray-300 rounded-md"
        placeholder="Enter product description"></textarea>
      @error('description')
      <span class="text-red-500 text-sm">{{ $message }}</span>
    @enderror
    </div>

    <!-- Price -->
    <div class="mb-4">
      <label for="price" class="block text-sm font-medium text-gray-700">Price</label>
      <input type="number" id="price" name="price" class="mt-1 block w-full p-2 border border-gray-300 rounded-md"
        placeholder="Enter price">
      @error('price')
      <span class="text-red-500 text-sm">{{ $message }}</span>
    @enderror
    </div>

    <!-- Stock -->
    <div class="mb-4">
      <label for="stock" class="block text-sm font-medium text-gray-700">Stock</label>
      <input type="number" id="stock" name="stock" class="mt-1 block w-full p-2 border border-gray-300 rounded-md"
        placeholder="Enter price">
      @error('stock')
      <span class="text-red-500 text-sm">{{ $message }}</span>
    @enderror
    </div>

    <!-- parent_category_id -->
    <div class="mb-4">
      <label for="parent_category_id" class="block text-sm font-medium text-gray-700">parent_category_id</label>
      <input type="text" id="parent_category_id" name="parent_category_id"
        class="mt-1 block w-full p-2 border border-gray-300 rounded-md"
        placeholder="Enter product parent_category_id"></input>
      @error('parent_category_id')
      <span class="text-red-500 text-sm">{{ $message }}</span>
    @enderror
    </div>

    <!-- child_category_id -->
    <div class="mb-4">
      <label for="child_category_id" class="block text-sm font-medium text-gray-700">Child_category_id</label>
      <input type="text" id="child_category_id" name="child_category_id"
        class="mt-1 block w-full p-2 border border-gray-300 rounded-md"
        placeholder="Enter product child_category_id"></input>
      @error('child_category_id')
      <span class="text-red-500 text-sm">{{ $message }}</span>
    @enderror
    </div>

    <!-- added_by -->
    <div class="mb-4">
      <label for="added_by" class="block text-sm font-medium text-gray-700">added_by</label>
      <input type="text" id="added_by" name="added_by" class="mt-1 block w-full p-2 border border-gray-300 rounded-md"
        placeholder="Enter product added_by"></input>
      @error('added_by')
      <span class="text-red-500 text-sm">{{ $message }}</span>
    @enderror
    </div>

    <!-- brand_id -->
    <div class="mb-4">
      <label for="brand_id" class="block text-sm font-medium text-gray-700">brand_id</label>
      <input type="text" id="brand_id" name="brand_id" class="mt-1 block w-full p-2 border border-gray-300 rounded-md"
        placeholder="Enter product brand_id"></input>
      @error('brand_id')
      <span class="text-red-500 text-sm">{{ $message }}</span>
    @enderror
    </div>

    <!-- image -->
    <div class="mb-4">
      <label for="image" class="block text-sm font-medium text-gray-700">Product Image</label>
      <input type="file" id="image" name="image[]" class="mt-1 block w-full p-2 border border-gray-300 rounded-md"
        multiple>
      @error('image')
      <span class="text-red-500 text-sm">{{ $message }}</span>
    @enderror
    </div>

    <!-- size -->
    <div class="mb-4">
      <label for="size" class="block text-sm font-medium text-gray-700">Size</label>
      <input type="text" id="size" name="size" class="mt-1 block w-full p-2 border border-gray-300 rounded-md"
        placeholder="Enter product size"></input>
      @error('size')
      <span class="text-red-500 text-sm">{{ $message }}</span>
    @enderror
    </div>

    <!-- weight -->
    <div class="mb-4">
      <label for="weight" class="block text-sm font-medium text-gray-700">Weight</label>
      <input type="text" id="weight" name="weight" class="mt-1 block w-full p-2 border border-gray-300 rounded-md"
        placeholder="Enter product weight"></input>
      @error('weight')
      <span class="text-red-500 text-sm">{{ $message }}</span>
    @enderror
    </div>

    <!-- Color -->
    <div class="mb-4">
      <label for="color" class="block text-sm font-medium text-gray-700">Color</label>
      <input type="text" id="color" name="color" class="mt-1 block w-full p-2 border border-gray-300 rounded-md"
        placeholder="Enter  color"></input>
      @error('color')
      <span class="text-red-500 text-sm">{{ $message }}</span>
    @enderror
    </div>

    <!-- <div class="mb-4">
      <label for="category" class="block text-sm font-medium text-gray-700">Category</label>
      <select id="category" name="category" class="mt-1 block w-full p-2 border border-gray-300 rounded-md">
        <option value="electronics">Electronics</option>
        <option value="fashion">Fashion</option>
        <option value="home">Home</option>
      </select>
    </div> -->
    <!-- <div class="mb-4">
      <label for="category" class="block text-sm font-medium text-gray-700">Child Category</label>
      <select id="category" name="category" class="mt-1 block w-full p-2 border border-gray-300 rounded-md">
        <option value="electronics">Electronics</option>
        <option value="fashion">Fashion</option>
        <option value="home">Home</option>
      </select>
    </div> -->
    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-md">Add Product</button>
  </form>
</main>

<script>
  if ("{{session('success')}}") {
    alert("{{session('success')}}")
  }
  if ("{{session('error')}}") {
    alert("{{session('error')}}")
  }
</script>

@endsection