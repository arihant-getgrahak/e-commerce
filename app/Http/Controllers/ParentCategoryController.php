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
}
