<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Gallery;
use App\Models\ProductMeta;
use Storage;
use App\Http\Requests\ProductAddRequest;
use App\Models\ParentCategory;
use App\Models\ChildCategory;
use App\Models\Brand;


class ProductController extends Controller
{
    public function index()
    {
        $parent = ParentCategory::all();
        $child = ChildCategory::where("parent_category_id", 1)->get();
        $brand = Brand::all();
        return view("addproduct")->with("parent", $parent)->with("child", $child)->with("brand", $brand);
    }

    public function child_category($id)
    {
        $child = ChildCategory::where("parent_category_id", $id)->get();
        if (!count($child) > 0) {
            return response()->json([
                "status" => false,
            ], 400);
        }
        return response()->json([
            "status" => true,
            "data" => $child
        ], 200);
    }

    public function display()
    {
        $product = Product::with(["gallery", "meta", "brand", "parent", "children"])->paginate(10);
        if (!$product) {
            return view('productview')->with('product', []);
        }
        // dd($product);
        return view('productview')->with('product', $product);

        // return response()->json([
        //     "product" => $product
        // ], 200);
    }

    public function store(ProductAddRequest $request)
    {

        try {
            $data = [
                "name" => $request->name,
                "description" => $request->description,
                "price" => $request->price,
                "stock" => $request->stock,
                "parent_category_id" => $request->parent_category_id,
                "child_category_id" => $request->child_category_id,
                "added_by" => $request->added_by,
                "brand_id" => $request->brand_id,
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
                "product_id" => $product->id,
                "color" => $request->color,
                "size" => $request->size,
                "weight" => $request->weight,
            ];
            DB::beginTransaction();
            ProductMeta::create($data);
            DB::commit();

            $product = Product::where("id", $product->id)->with(["gallery", "meta", "brand"])->first();

            // return response()->json([
            //     "product" => $product,
            // ], 201);

            return back()->with("success", "Product created successfully");
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with("error", $e->getMessage());
        }
    }

    public function update(Request $request, $id)
    {
        $product = Product::with('gallery')->find($id);
        if (!$product) {
            return response()->json([
                "message" => "Product not found"
            ], 404);
        }


        DB::beginTransaction();

        try {

            $updateData = $request->only([
                'name',
                'description',
                'price',
                'stock',
                'parent_category_id',
                'child_category_id',
                'added_by',
            ]);

            $product->update($updateData);


            if ($request->hasFile('image')) {
                $imageFiles = is_array($request->file('image')) ? $request->file('image') : [$request->file('image')];


                foreach ($product->gallery as $galleryImage) {
                    Storage::delete($galleryImage->image); // Delete from storage
                    $galleryImage->delete(); // Delete from DB
                }


                foreach ($imageFiles as $file) {
                    $imagePath = $this->uploadImage($file);

                    Gallery::create([
                        'product_id' => $product->id,
                        'image' => $imagePath,
                    ]);
                }
            }


            DB::commit();

            $product->load('gallery');

            return response()->json([
                "product" => $product
            ], 200);

        } catch (\Exception $e) {

            DB::rollBack();

            return response()->json([
                "message" => "An error occurred while updating the product.",
                "error" => $e->getMessage(),
            ], 500);
        }
    }


    public function delete($id)
    {
        $product = Product::find($id);
        if (!$product) {
            return response()->json([
                "message" => "Product not found"
            ], 404);
        }
        $product->delete();
        return response()->json([
            "message" => "Product deleted successfully"
        ], 200);
    }

    public function specific($id)
    {

        $product = Product::where("id", $id)->with(["gallery", "meta", "brand", "parent", "children"])->get();
        if (!$product) {
            return response()->json([
                "message" => "Product not found"
            ], 404);
        }

        return response()->json([
            "product" => $product
        ], 200);
    }

    protected function uploadImage($file)
    {
        $uploadFolder = 'product';
        $image = $file;
        $image_uploaded_path = $image->store($uploadFolder, 'public');
        $uploadedImageUrl = Storage::disk('public')->url($image_uploaded_path);

        return $uploadedImageUrl;
    }
}
