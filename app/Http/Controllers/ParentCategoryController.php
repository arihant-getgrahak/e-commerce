<?php

namespace App\Http\Controllers;

use App\Models\ParentCategory;
use Illuminate\Http\Request;
use Validator;
use App\Http\Requests\ParentCategoryStoreRequest;

class ParentCategoryController extends Controller
{
    public function display()
    {
        $category = ParentCategory::all();
        return response()->json([
            "category" => $category
        ], 200);
    }
    public function store(ParentCategoryStoreRequest $request)
    {
       
        $category = ParentCategory::create([
            'name' => $request->name
        ]);

        if (!$category) {
            return response()->json([
                "message" => "Category not created"
            ], 400);
        }

        return response()->json([
            "message" => "Category created successfully",
            "category" => $category
        ], 200);
    }
    public function update(Request $request, $id)
    {
        $category = ParentCategory::find($id);
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
        $category = ParentCategory::find($id);
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
}
