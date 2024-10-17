<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Gallery;
use Storage;
use App\Http\Requests\ProductAddRequest;

class ProductController extends Controller
{
    // public function index(){
    //     return view("product");
    // }

    public function store(ProductAddRequest $request)
    {

        $data = [
            "name" => $request->name,
            "description" => $request->description,
            "price" => $request->price,
            "stock" => $request->stock,
            "parent_category_id" => $request->parent_category_id,
            "child_category_id" => $request->child_category_id,
            "added_by" => $request->added_by,
        ];

        $product = Product::create($data);


        if ($request->hasFile('image')) {
            $imageFiles = is_array($request->file('image')) ? $request->file('image') : [$request->file('image')];


            foreach ($imageFiles as $file) {
                $imagePath = $this->uploadImage($file);

                Gallery::create([
                    'product_id' => $product->id,
                    'image' => $imagePath,
                ]);
            }
        }

        $product = Product::where("id", $product->id)->with("gallery")->first();

        return response()->json([
            "product" => $product,
        ], 201);
    }


    public function update(Request $request, $id)
    {
        $product = Product::find($id);
        if (!$product) {
            return response()->json([
                "message" => "Product not found"
            ], 404);
        }
        $product->update($request->all());

        return response()->json([
            "product" => $product
        ], 200);
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

        $product = Product::where("id", $id)->with("gallery")->get();
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
