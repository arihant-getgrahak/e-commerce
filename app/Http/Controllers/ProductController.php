<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Gallery;

class ProductController extends Controller
{
    // public function index(){
    //     return view("product");
    // }

    public function display()
    {
        $product = Product::with("gallery")->get();
        // return view("product", compact("product"));
        return response()->json([
            "product" => $product,
        ], 200);
    }

    public function store(Request $request)
    {
        $product = Product::create($request->all());
        $gallery = Gallery::create($request->all());
        return response()->json([
            "product" => $product,
            "gallery" => $gallery
        ], 201);
    }

    public function update(Request $request, $id)
    {
        $product = Product::find($id);
        if (!$product) {
            return response()->json([
                "message" => "Product not found"
            ], 404);
        }
        $product->update($request->all());

        return response()->json([
            "product" => $product
        ], 200);
    }

    
}
