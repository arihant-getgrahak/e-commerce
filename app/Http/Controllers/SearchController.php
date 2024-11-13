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
        $isLoggedin = auth()->check();
        $search = null;
        $recentSearches = null;

        if ($isLoggedin) {
            $recentSearches = Search::where('user_id', auth()->user()->id)->get();
        } else {
            $recentSearches = Search::where('session_id', session()->getId())->get();
        }
        session()->remove('recentsearch');
        session()->put('recentsearch', $recentSearches);

        if ($isLoggedin) {
            $search = Search::where('search_keyword', $request->search)->where('user_id', auth()->user()->id)->first();
        } else {
            $search = Search::where('search_keyword', $request->search)->where('session_id', session()->getId())->first();
        }

        if ($search) {
            $search->update([
                'count' => $search->count + 1,
            ]);
        } else {
            if (auth()->check()) {
                Search::create([
                    'search_keyword' => $request->search,
                    'count' => 1,
                    'user_id' => auth()->user()->id,
                ]);
            } else {
                Search::create([
                    'search_keyword' => $request->search,
                    'count' => 1,
                    'session_id' => session()->getId(),
                ]);
            }
        }

        if ($searchProduct->isNotEmpty()) {
            return back()->with('search', $searchProduct);
        }

        return back()->with('search', []);
    }
}
