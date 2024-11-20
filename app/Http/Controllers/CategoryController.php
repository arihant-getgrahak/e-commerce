<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryStoreRequest;
use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Validator;

class CategoryController extends Controller
{
    // for parent
    public function index()
    {
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

        return view('addcategroy', compact('data'));
    }

    public function display()
    {
        $category = Category::all();

        return response()->json([
            'category' => $category,
        ], 200);
    }

    public function store(CategoryStoreRequest $request)
    {

        $category = Category::create([
            'name' => $request->name,
            'parent_id' => $request->parent_id ?? null,
        ]);

        if (! $category) {
            return response()->json([
                'message' => 'Category not created',
            ], 400);
        }

        // return response()->json([
        //     "message" => "Category created successfully",
        //     "category" => $category
        // ], 200);

        return back()->with('success', 'Category created successfully');
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'parent_id' => 'nullable|exists:categories,id',
        ]);
        if ($validator->fails()) {

            return back()->with('errors', $validator->errors());
        }
        $category = Category::find($id);

        $data = $request->only(['name', 'parent_id']);
        $category->update($data);

        return back()->with('success', 'Category updated successfully');
        // return response()->json([
        //     'message' => 'Category updated successfully',
        //     'category' => $category,
        // ], 200);
    }

    public function delete($id)
    {
        $category = Category::find($id);
        if (! $category) {
            return back()->with('error', 'Incorrect category id');
        }

        // $order = Order::with('products.product')->whereHas('products.product', function ($query) use ($id) {
        //     $query->where('category_id', $id);
        // });

        $hasOrders = Order::whereHas('products.product', function ($query) use ($id) {
            $query->where('category_id', $id);
        })->exists();

        if ($hasOrders) {
            return back()->with('error', 'Cannot delete category with orders');
        }

        $category->delete();

        return back()->with('success', 'Category deleted successfully');
    }

    // for child
    public function storechild(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'name' => 'required',
            'parent_id' => 'required|exists:categories,id',
        ]);

        if ($validate->fails()) {
            return back()->with('errors', $validate->errors());
        }
        $category = Category::create([
            'parent_id' => $request->parent_id,
            'name' => $request->name,
        ]);

        if (! $category) {
            return back()->with('errors', 'Child Category not created');
        }

        return back()->with('success', 'Child Category created successfully');
    }

    public function filter($id)
    {
        $category = Category::find($id);

        if (! $category) {
            return response()->json([
                'message' => 'Category not found',
            ], 404);
        }
        $product = Product::where('category_id', $id)->with(['gallery', 'meta', 'brand', 'category'])->get();

        return response()->json([
            'product' => $product,
        ], 200);

        // return view('category', compact('product'));
    }
}
