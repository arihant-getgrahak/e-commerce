<?php

namespace App\Http\Controllers;

use App\Models\ChildCategory;
use Illuminate\Http\Request;

class ChildCategoryController extends Controller
{
    public function display()
    {
        $category = ChildCategory::with("category")->get();
        return response()->json([
            "category" => $category
        ], 200);
    }
}
