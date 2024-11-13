<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Search;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        $query = Product::query();

        if ($request->category) {
            $query->where('category_id', $request->category);
        }

        if ($request->search) {
            $query->where('name', 'like', '%'.$request->search.'%');
        }

        $searchProduct = $query->get();

        echo $searchProduct;

        $search = Search::where('search_keyword', $request->search)->first;
        if ($search) {
            $search->update([
                'count' => $search->count + 1,
            ]);
        } else {
            Search::create([
                'search_keyword' => $request->search,
                'count' => 1,
            ]);
        }

        if ($searchProduct->isNotEmpty()) {
            return response()->json([
                'message' => 'Product found',
                'products' => $searchProduct,
            ], 200);
        }

        return response()->json([
            'message' => 'Product not found',
        ], 404);
    }
}
