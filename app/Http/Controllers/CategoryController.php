<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Validator;
use App\Http\Requests\CategoryStoreRequest;

class CategoryController extends Controller
{

    // for parent
    public function index()
    {
        $category = Category::where("parent_id", null)->get();
        return view("addcategroy", compact("category"));
    }
    public function display()
    {
        $category = Category::all();
        return response()->json([
            "category" => $category
        ], 200);
    }
    public function store(CategoryStoreRequest $request)
    {

        $category = Category::create([
            'name' => $request->name
        ]);

        if (!$category) {
            return response()->json([
                "message" => "Category not created"
            ], 400);
        }

        // return response()->json([
        //     "message" => "Category created successfully",
        //     "category" => $category
        // ], 200);

        return back()->with("success", "Category created successfully");
    }
    public function update(Request $request, $id)
    {
        $category = Category::find($id);
        if (!$category) {
            return response()->json([
                "message" => "Category not found"
            ], 404);
        }
        $validator = Validator::make($request->all(), [
            'name' => 'required'
        ]);
        if ($validator->fails()) {
            return response()->json([
                "message" => "Validation error",
                "errors" => $validator->errors()
            ], 400);
        }
        $category->update([
            "name" => $request->name
        ]);
        return response()->json([
            "message" => "Category updated successfully",
            "category" => $category
        ], 200);
    }

    public function delete($id)
    {
        $category = Category::find($id);
        if (!$category) {
            return response()->json([
                "status" => false,
                "message" => "Category not found"
            ], 404);
        }

        $category->delete();
        return response()->json([
            "status" => true,
            "message" => "Category deleted successfully"
        ], status: 200);
    }

    // for child
    public function storechild(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'name' => 'required',
            "parent_id" => 'required|exists:categories,id'
        ]);

        if ($validate->fails()) {
            return back()->with('errors', $validate->errors());
        }
        $category = Category::create([
            "parent_id" => $request->parent_id,
            "name" => $request->name
        ]);

        if (!$category) {
            return back()->with("errors", "Child Category not created");
        }

        return back()->with("success", "Child Category created successfully");
    }
}
