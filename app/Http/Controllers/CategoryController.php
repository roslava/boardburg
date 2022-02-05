<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Skate;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{
    public function index(Request $request, Auth $auth, Skate $skate )
    {
        $skateQuery = whoseRequest($auth, $skate);
        priceFilter($request, $skateQuery);
        switch ($request->input('category')) {
            case 'category_1':
                $skateQuery->where('category_id', 1);
                break;
            case 'category_2':
                $skateQuery->where('category_id', 2);
                break;
            case 'category_3':
                $skateQuery->where('category_id', 3);
                break;
            case 'category_4':
                $skateQuery->where('category_id', 4);
                break;
            case 'category_5':
                $skateQuery->where('category_id', '>', 0);
                if ($request->filled('price_from') or $request->filled('price_to')) {
                    priceFilter($request, $skateQuery);
                } else {
                    return redirect()->route('skates_base.index');
                }
                break;
        }
        $quantity = current_quantity($skateQuery);
        $skatesFromBase = $skateQuery->paginate(8)->withQueryString();
        return view('home', ['skatesFromBase' => $skatesFromBase, 'quantity' => $quantity]);
    }
}
