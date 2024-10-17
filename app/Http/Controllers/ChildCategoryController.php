<?php

namespace App\Http\Controllers;

use App\Models\ChildCategory;
use Illuminate\Http\Request;
use Validator;
use App\Http\Requests\ChildCategoryStoreRequest;

class ChildCategoryController extends Controller
{
    public function display()
    {
        $category = ChildCategory::with("parent")->get();
        return response()->json([
            "category" => $category
        ], 200);
    }
    public function store(ChildCategoryStoreRequest $request)
    {
        $data = [
            "name" => $request->name,
            "parent_category_id" => $request->parent_category_id,
        ];

        $childCategory = ChildCategory::create($data);

        if (!$childCategory) {
            return response()->json([
                "message" => "Child category not created"
            ], 400);
        }
        return response()->json([
            "message" => "Child category created successfully",
            "category" => $childCategory
        ], 200);
    }

    public function update(Request $request, $id)
    {
        $category = ChildCategory::find($id);
        if (!$category) {
            return response()->json([
                "message" => "Category not found"
            ], 404);
        }
        $data = $request->only([
            "name",
        ]);
        $category->update($data);
        return response()->json([
            "message" => "Category updated successfully",
            "category" => $category
        ], 200);
    }

    public function delete($id)
    {
        $category = ChildCategory::find($id);
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
