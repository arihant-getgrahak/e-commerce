<?php

namespace App\Http\Controllers;

use App\Models\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function display($id)
    {
        $review = Review::where("product_id", $id)->get();
        return response()->json(["review" => $review], 200);
    }

    
}
