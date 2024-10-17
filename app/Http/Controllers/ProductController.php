<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    // public function index(){
    //     return view("product");
    // }

    public function display(){
        $product = Product::all();
        // return view("product", compact("product"));
        return response()->json([
            "product"=> $product
        ]);
    }
}
