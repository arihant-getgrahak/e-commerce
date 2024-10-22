@extends('layout.index')

@section('productadd')
<main>
  <h2 class="text-3xl font-bold mb-4">Add Product</h2>
  <form id="productForm" class="bg-white p-6 rounded-lg shadow-lg" method="post" action={{ route('product.add') }}
    enctype="multipart/form-data">
    @csrf

    <!-- Name -->
    <div class="mb-4">
      <label for="name" class="col-form-label required">Product Name</label>
      <input type="text" id="name" name="name" class="mt-1 block w-full p-2 border border-gray-300 rounded-md"
        placeholder="Enter product name" value="{{ old('name') }}">
      @error('name')
      <p class="text-red-500">{{ $message }}</p>
    @enderror
    </div>

    <!-- Description -->
    <div class="mb-4">
      <label for="description" class="col-form-label required">Description</label>
      <textarea id="description" name="description" class="mt-1 block w-full p-2 border border-gray-300 rounded-md"
        placeholder="Enter product description">{{ old('description') }}</textarea>
      @error('description')
      <p class="text-red-500">{{ $message }}</p>
    @enderror
    </div>

    <!-- Price -->
    <div class="mb-4">
      <label for="price" class="col-form-label required">Price</label>
      <input type="number" id="price" name="price" class="mt-1 block w-full p-2 border border-gray-300 rounded-md"
        placeholder="Enter price" value="{{ old('price') }}">
      @error('price')
      <p class="text-red-500">{{ $message }}</p>
    @enderror
    </div>

    <!-- Stock -->
    <div class="mb-4">
      <label for="stock" class="col-form-label required">Stock</label>
      <input type="number" id="stock" name="stock" class="mt-1 block w-full p-2 border border-gray-300 rounded-md"
        placeholder="Enter stock quantity" value="{{ old('stock') }}">
      @error('stock')
      <p class="text-red-500">{{ $message }}</p>
    @enderror
    </div>

    <!-- Images -->
    <div class="mb-4">
      <label for="image" class="col-form-label required">Product Images</label>
      <input type="file" id="image" name="image[]" class="form-control" multiple>
      @error('image')
      <p class="text-red-500">{{ $message }}</p>
    @enderror
    </div>

    <!-- Weight -->
    <div class="mb-4">
      <label for="sku" class="col-form-label required">sku</label>
      <input type="text" id="sku" name="sku" class="mt-1 block w-full p-2 border border-gray-300 rounded-md"
        placeholder="Enter product sku" value="{{ old('sku') }}">
      @error('sku')
      <p class="text-red-500">{{ $message }}</p>
    @enderror
    </div>

    <!-- Sku -->
    <div class="mb-4">
      <label for="weight" class="col-form-label required">Weight</label>
      <input type="text" id="weight" name="weight" class="mt-1 block w-full p-2 border border-gray-300 rounded-md"
        placeholder="Enter product weight" value="{{ old('weight') }}">
      @error('weight')
      <p class="text-red-500">{{ $message }}</p>
    @enderror
    </div>


    <!-- Category -->
    <div class="mb-4">
      <label for="category_id" class="col-form-label required">Category</label>
      <select id="category_id" name="category_id" class="mt-1 block w-full p-2 border border-gray-300 rounded-md">
        @foreach($category as $cat)
      <option value="{{ $cat['id'] }}" {{ old('category_id') == $cat['id'] ? 'selected' : '' }}>{{ $cat['name'] }}
      </option>
    @endforeach
      </select>
      @error('category_id')
      <p class="text-red-500">{{ $message }}</p>
    @enderror
    </div>

    <!-- Brand -->
    <div class="mb-4">
      <label for="brand_id" class="col-form-label required">Brand</label>
      <select id="brand_id" name="brand_id" class="mt-1 block w-full p-2 border border-gray-300 rounded-md">
        @foreach ($brand as $p)
      <option value="{{ $p->id }}" {{ old('brand_id') == $p->id ? 'selected' : '' }}>{{ $p->name }}</option>
    @endforeach
      </select>
      @error('brand_id')
      <p class="text-red-500">{{ $message }}</p>
    @enderror
    </div>

    <!-- Submit Button -->
    <button type="submit" class="btn btn-primary ms-auto">Add Product</button>
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