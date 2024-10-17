<?php

namespace App\Http\Controllers;

use App\Models\ParentCategory;
use Illuminate\Http\Request;
use Validator;

class ParentCategoryController extends Controller
{
    public function display()
    {
        $category = ParentCategory::all();
        return response()->json([
            "category" => $category
        ], 200);
    }
    public function store(Request $request)
    {
        if ($request->name == null) {
            return response()->json([
                "message" => "Category name is required"
            ], 400);
        }
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
}
