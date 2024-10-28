<?php

namespace App\Http\Controllers;

use App\Http\Requests\BrandStoreRequest;
use App\Models\Brand;
use App\Models\Product;
use Illuminate\Http\Request;
use Storage;
use Validator;

class BrandController extends Controller
{
    public function index()
    {
        $brand = Brand::all();

        return view('brand', compact('brand'));
    }

    public function display()
    {
        $brand = Brand::with(['products', 'products.gallery', 'products.parent', 'products.children'])->paginate(10);

        // $brand = Brand::paginate(10);
        return response()->json([
            'brand' => $brand,
        ], 200);
    }

    public function store(BrandStoreRequest $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validation error',
                'errors' => $validator->errors(),
            ], 400);
        }

        $brand = Brand::create([
            'name' => $request->name,
            'image' => $this->uploadImage($request->image),
        ]);

        if (! $brand) {
            return back()->with('errors', 'Brand not created');
            // return response()->json([
            //     "message" => "Brand not created"
            // ], 400);
        }

        return back()->with('success', 'Brand created successfully');
        // return response()->json([
        //     "message" => "Brand created successfully",
        //     "brand" => $brand
        // ], 200);
    }

    public function update(Request $request, $id)
    {
        $brand = Brand::find($id);

        if (! $brand) {
            return back()->with('errors', 'Brand not found');
        }

        $updateData = $request->only(['name']);

        if ($request->hasFile('image')) {
            $image = $this->uploadImage($request->file('image'));
            $updateData['image'] = $image;
        }

        $brand->update($updateData);

        return back()->with('success', 'Brand updated successfully');
    }

    public function destroy($id)
    {
        $brand = Brand::find($id);
        if (! $brand) {
            return back()->with('errors', 'Brand not found');
            // return response()->json([
            //     'message' => 'Brand not found',
            // ], 404);
        }
        Storage::delete($brand->image);
        $brand->delete();

        return back()->with('success', 'Brand deleted successfully');
        // return response()->json([
        //     'message' => 'Brand deleted successfully',
        // ], 200);
    }

    public function filter(Request $request)
    {

        // dd($request->all());
        $validate = Validator::make($request->all(), [
            'brandId' => 'required|array',
            'brandId.*' => 'exists:brands,id|integer',
        ]);

        if ($validate->fails()) {
            return response()->json([
                'message' => 'Validation error',
                'errors' => $validate->errors(),
            ], 400);
        }

        $product = Product::whereIn('brand_id', $request->brandId)->with(['gallery', 'meta', 'brand', 'category'])->paginate(10);

        return response()->json([
            'product' => $product,
        ], 200);
    }

    protected function uploadImage($file)
    {
        $uploadFolder = 'brand';
        $image = $file;
        $image_uploaded_path = $image->store($uploadFolder, 'public');
        $uploadedImageUrl = Storage::disk('public')->url($image_uploaded_path);

        return $uploadedImageUrl;
    }
}
