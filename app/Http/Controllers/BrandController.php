<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    public function display()
    {
        $brand = Brand::with("products")->paginate(10);
        return response()->json([
            "brand" => $brand
        ], 200);
    }
}
