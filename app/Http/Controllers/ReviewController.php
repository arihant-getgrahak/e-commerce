<?php

namespace App\Http\Controllers;

use App\Models\Review;
use Illuminate\Http\Request;
use Validator;

class ReviewController extends Controller
{
    public function display($id)
    {
        $review = Review::where("product_id", $id)->get();
        return response()->json(["review" => $review], 200);
    }

    public function store(Request $request)
    {
        $validate = Validator::make($request->all(), [
            "product_id" => "required|exists:products,id",
            "comment" => "required",
            "rating" => "required",
            "name" => "required",
            "email" => "required|email",
        ]);

        if ($validate->fails()) {
            return response()->json(["error" => $validate->errors()], 400);
        }

        $data = [
            "product_id" => $request->product_id,
            "comment" => $request->comment,
            "name" => $request->name,
            "email" => $request->email,
            "rating" => $request->rating,
        ];

        $review = Review::create($data);

        return response()->json(["review" => $review], 200);
    }
}
