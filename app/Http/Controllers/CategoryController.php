<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{
    public function index(Request $request, Auth $auth, Product $product)
    {
        if ($auth::check() && $auth::user()->isAdmin()) {
            $productQuery = $product::query();
        } elseif ($auth::check() && $auth::user()['role'] === 'manager') {
            $currentUserId = $auth::user()['id'];
            $productQuery = $product::query()->where('user_id', '=', $currentUserId);
        } else {
            $productQuery = $product::query();
        }
        priceFilter($request, $productQuery);
        switch ($request->input('category')) {
            case 'category_1':
                $productQuery->where('category_id', 1);
                break;
            case 'category_2':
                $productQuery->where('category_id', 2);
                break;
            case 'category_3':
                $productQuery->where('category_id', 3);
                break;
            case 'category_4':
                $productQuery->where('category_id', 4);
                break;
            case 'category_5':
                $productQuery->where('category_id', '>', 0);
                if ($request->filled('price_from') or $request->filled('price_to')) {
                    priceFilter($request, $productQuery);
                } else {
                    return redirect()->route('products_base.index');
                }
                break;
        }
        $productsFromBase = $productQuery->paginate(8)->withQueryString();
        return view('home', ['productsFromBase' => $productsFromBase, 'quantity' => $productQuery->count()]);
    }
}
