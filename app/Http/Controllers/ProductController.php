<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductAddRequest;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Gallery;
use App\Models\Product;
use App\Models\ProductMeta;
use DB;
use Illuminate\Http\Request;
use Storage;

class ProductController extends Controller
{
    public function index()
    {
        $categories = Category::with('parent')->get();
        $data = [];

        foreach ($categories as $category) {
            if ($category->parent) {
                $data[] = [
                    'id' => $category->id,
                    'name' => $category->parent->name.' - '.$category->name,
                ];
            } else {
                $data[] = [
                    'id' => $category->id,
                    'name' => $category->name,
                ];
            }
        }

        // dd($data);
        $brand = Brand::all();

        return view('addproduct')->with('category', $data)->with('brand', $brand);
    }

    public function admindisplay()
    {
        $product = Product::where('added_by', auth()->user()->id)->with(['gallery', 'meta', 'brand', 'category'])->paginate(10);
        $categories = Category::with('parent')->get();
        $data = [];

        foreach ($categories as $category) {
            if ($category->parent) {
                $data[] = [
                    'id' => $category->id,
                    'name' => $category->parent->name.' - '.$category->name,
                    'parent_id' => $category->parent_id,
                ];
            } else {
                $data[] = [
                    'id' => $category->id,
                    'name' => $category->name,
                ];
            }
        }

        if (! $product) {
            return view('productview')->with('product', []);
        }

        // dd($product);
        return view('productview')->with('product', $product)->with('category', $data);

        // return response()->json([
        //     "product" => $product
        // ], 200);
    }

    public function display()
    {
        $product = Product::with(['gallery', 'meta', 'brand', 'category'])->paginate(10);
        if (! $product) {
            return view('welcome')->with('product', []);
        }

        return view('welcome')->with('product', $product);
    }

    public function store(ProductAddRequest $request)
    {

        try {
            $data = [
                'name' => $request->name,
                'description' => $request->description,
                'price' => $request->price,
                'stock' => $request->stock,
                'category_id' => $request->category_id,
                'added_by' => auth()->user()->id,
                'brand_id' => $request->brand_id,
                'slug' => $request->slug,
                'thumbnail' => $this->uploadImage($request->file('thumbnail')),
                'cost_price' => $request->cost_price,
            ];
            DB::beginTransaction();
            $product = Product::create($data);
            DB::commit();

            if ($request->hasFile('image')) {
                if (is_array($request->file('image'))) {
                    $imageFiles = $request->file('image');
                    foreach ($request->file('image') as $file) {
                        $imagePath = $this->uploadImage($file);
                        DB::beginTransaction();
                        Gallery::create([
                            'product_id' => $product->id,
                            'image' => $imagePath,
                        ]);
                        DB::commit();
                    }
                } else {
                    $imagePath = $this->uploadImage($request->file('image'));
                    DB::beginTransaction();
                    Gallery::create([
                        'product_id' => $product->id,
                        'image' => $imagePath,
                    ]);
                    DB::commit();
                }
            }

            $data = [
                'product_id' => $product->id,
                'sku' => $request->sku,
                'weight' => $request->weight,
            ];
            DB::beginTransaction();
            ProductMeta::create($data);
            DB::commit();

            // return response()->json([
            //     "success" => "Product created successfully",
            //     "product" => $product,
            // ], 201);

            return back()->with('success', 'Product created successfully');
        } catch (\Exception $e) {
            DB::rollBack();

            return back()->with('error', $e->getMessage());
            // return response()->json([
            //     "success" => false,
            //     "error" => $e->getMessage(),
            // ], 500);
        }
    }

    public function update(Request $request, $id)
    {
        $product = Product::with('gallery')->find($id);
        if (! $product) {
            return response()->json([
                'message' => 'Product not found',
            ], 404);
        }

        DB::beginTransaction();

        try {
            if ($request->hasFile('thumbnail')) {
                $thumbnail = $this->uploadImage($request->file('thumbnail'));
                $product->thumbnail = $thumbnail;
            }

            $updateData = $request->only([
                'name',
                'description',
                'price',
                'stock',
                'category_id',
                'added_by',
                'cost_price',
            ]);

            $product->fill($updateData)->save();

            if ($request->hasFile('image')) {
                $product->gallery()->delete();
                $images = is_array($request->file('image')) ? $request->file('image') : [$request->file('image')];

                $galleryImages = [];
                foreach ($images as $file) {
                    $imagePath = $this->uploadImage($file);
                    $galleryImages[] = [
                        'product_id' => $product->id,
                        'image' => $imagePath,
                    ];
                }
                Gallery::insert($galleryImages);
            }

            DB::commit();

            $product->load('gallery');

            return back()->with('success', 'Product updated successfully');

        } catch (\Exception $e) {
            DB::rollBack();

            return back()->with('error', 'An error occurred while updating the product: '.$e->getMessage());
        }
    }

    public function delete($id)
    {
        $product = Product::find($id);
        if (! $product) {

            return back()->with('error', 'Incorrect product id');
            // return response()->json([
            //     "message" => "Product not found"
            // ], 404);
        }
        $product->delete();

        return back()->with('success', 'Product deleted successfully');
        // return response()->json([
        //     "message" => "Product deleted successfully"
        // ], 200);
    }

    public function specific($id)
    {

        $product = Product::where('slug', $id)->with(['gallery', 'meta', 'brand', 'category'])->get();
        if (! $product) {
            return view('specificproduct')->with('error', 'Incorrect product id');
        }

        return view('specificproduct')->with('product', $product);

    }

    protected function uploadImage($file)
    {
        // dd($file);
        $uploadFolder = 'product';
        $image = $file;
        $image_uploaded_path = $image->store($uploadFolder, 'public');
        $uploadedImageUrl = Storage::disk('public')->url($image_uploaded_path);

        return $uploadedImageUrl;
    }
}
