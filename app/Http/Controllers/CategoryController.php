<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Skate;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{

    public function index(Request $request)
    {
        $currentUserId = auth()->user()->id;



        If(Auth::check() && Auth::user()->isAdmin()) {
            $skateQuery = Skate::query();
            $quantity = count(Skate::all());
        }elseif (Auth::check() && auth()->user()->role ==='guest'){
            $skateQuery = Skate::query();
            $quantity = count(Skate::all());
        }else{
            $skateQuery = Skate::query()->where('user_id','=', $currentUserId );
            $quantity = $skateQuery->count();
        } // метод query()



        if ($request->filled('price_from')) {
            $skateQuery->where('price', '>=', $request['price_from']);
            $quantity = $skateQuery->count();
        }
        if ($request->filled('price_to')) {
            $skateQuery->where('price', '<=', $request['price_to']);
            $quantity = $skateQuery->count();
        }

        if ($request->input('category') == 'category_1') {
            $skateQuery->where('category_id', 1);
            $quantity = $skateQuery->count();
        }

        if ($request->input('category') == 'category_2') {
            $skateQuery->where('category_id', 2);
            $quantity = $skateQuery->count();
        }

        if ($request->input('category') == 'category_3') {
            $skateQuery->where('category_id', 3);
            $quantity = $skateQuery->count();
        }

        if ($request->input('category') == 'category_4') {
            $skateQuery->where('category_id', 4);
            $quantity = $skateQuery->count();
        }

        if ($request->input('category') == 'category_5') {
            $skateQuery->where('category_id', '>', 0);


        }


        $skatesFromBase = $skateQuery->paginate(8)->withQueryString();

        return view('skates', ['skatesFromBase' => $skatesFromBase, 'quantity' => $quantity]);

    }
}
