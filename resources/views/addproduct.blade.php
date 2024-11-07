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

    <!-- slug -->
    <div class="mb-4">
      <label for="slug" class="col-form-label required">Product Slug</label>
      <input type="text" id="slug" name="slug" class="mt-1 block w-full p-2 border border-gray-300 rounded-md"
        placeholder="Enter product slug" value="{{ old('slug') }}">
      @error('slug')
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
      <label for="price" class="col-form-label required">Selling Price</label>
      <input type="float" id="price" name="price" class="mt-1 block w-full p-2 border border-gray-300 rounded-md"
        placeholder="Enter price" value="{{ old('price') }}">
      @error('price')
      <p class="text-red-500">{{ $message }}</p>
    @enderror
    </div>

    <!-- Price -->
    <div class="mb-4">
      <label for="cost_price" class="col-form-label required">Cost Price</label>
      <input type="float" id="cost_price" name="cost_price"
        class="mt-1 block w-full p-2 border border-gray-300 rounded-md" placeholder="Enter price"
        value="{{ old('cost_price') }}">
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

    <!-- Thumbnail -->
    <div class="mb-4">
      <label for="thumbnail" class="col-form-label required">Product Thumbnail</label>
      <input type="file" id="thumbnail" name="thumbnail" class="form-control">
      @error('thumbnail')
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
    
    <!-- attribute -->
    <div class="mb-4">
      <label for="attribute" class="col-form-label required">Attributes</label>
      <select id="attribute" name="attribute" class="mt-1 block w-full p-2 border border-gray-300 rounded-md">
        @foreach($attribute as $cat)
      @foreach ($cat->values as $values)
      <option value="{{ $values["id"] }}">{{ $cat['name'] . " - " . $values['value'] }}</option>
    @endforeach
      </option>
    @endforeach
      </select>
    </div>

    <!-- Submit Button -->
    <button type="submit" class="btn btn-primary ms-auto">Add Product</button>
  </form>
</main>

<script>

  document.getElementById('name').addEventListener('input', function (e) {
    let name = e.target.value;
    let slug = name.toLowerCase()
      .replace(/[^\w\s-]/g, '')
      .trim()
      .replace(/\s+/g, '-');
    document.getElementById('slug').value = slug;
  });
</script>

<script>
  const arihant = document.querySelector('#alert');
  if ("{{session('success')}}") {
    arihant.innerHTML = `
            <div class="alert alert-success alert-dismissible fade show" role="alert">
        ${{{ session('success') }}}
                                              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
												<span aria-hidden="true">&times;</span>
											  </button>
											</div>
                                            `
    window.scrollTo(0, 0);
  }
  if ("{{session('error')}}") {
    arihant.innerHTML = `
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
        ${{{ session('error') }}}
                                              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
												<span aria-hidden="true">&times;</span>
											  </button>
											</div>
                                            `
    window.scrollTo(0, 0);
  }
</script>

@endsection