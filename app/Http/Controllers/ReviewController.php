<?php

namespace App\Http\Controllers;

use App\Models\Review;
use Illuminate\Http\Request;
use Validator;
use App\Http\Requests\ReviewStoreRequest;

class ReviewController extends Controller
{
    public function display($id)
    {
        $review = Review::where("product_id", $id)->get();
        return response()->json(["review" => $review], 200);
    }

    public function store(ReviewStoreRequest $request)
    {
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
