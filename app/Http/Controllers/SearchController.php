<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class SearchController extends Controller
{
    public function search(Request $request, Product $product)
    {
        $search = $request['search_input_bb'];
        if(!auth::check() || !Auth::user()->isAdmin()) if (Auth::check() && auth()->user()['role'] === 'manager') {
            $currentUserId = auth()->user()['id'];
            $productsFromBaseQuery = $product->query()->where('user_id', '=', $currentUserId)->where('name', 'LIKE', "%$search%");
            $quantity = count($productsFromBaseQuery->get());
            $productsFromBase = $productsFromBaseQuery->orderBy('name')->paginate(8)->withQueryString();
        } else {
            $productsFromBaseQuery = $product::query()->where('name', 'LIKE', "%$search%");
            $quantity = count($productsFromBaseQuery->get());
            $productsFromBase = $productsFromBaseQuery->orderBy('name')->paginate(8)->withQueryString();
        } else {
            $productsFromBaseQuery = $product::query()->where('name', 'LIKE', "%$search%");
            $quantity = count($productsFromBaseQuery->get());
            $productsFromBase = $productsFromBaseQuery->orderBy('name')->paginate(8)->withQueryString();
        }
        return view('home', compact('productsFromBase', 'quantity', 'search'));
    }
}
