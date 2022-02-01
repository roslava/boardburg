<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Skate;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{

    public function index(Request $request)
    {
        if (Auth::check() && Auth::user()->isAdmin()) {
            $skateQuery = Skate::query();
        } elseif (Auth::check() && auth()->user()->role === 'manager') {
            $currentUserId = auth()->user()->id;
            $skateQuery = Skate::query()->where('user_id', '=', $currentUserId);
        } else {
            $skateQuery = Skate::query();
        } // метод query()

        function price($request, $skateQuery)
        {
            if ($request->filled('price_from')) {
                $skateQuery->where('price', '>=', $request['price_from']);

            }
            if ($request->filled('price_to')) {
                $skateQuery->where('price', '<=', $request['price_to']);
            }
        }

        price($request, $skateQuery);

        $quantity = $skateQuery->count();

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

        //В фильтре могут быть выбраны все товары без фильрации по цене, тогда выхожу из фильтра, перенаправяю на главную со всеми товарами,
        //если выбраны все товары с фильтрацией по цене запускаю функцию price() фильтрации по цене
        if ($request->input('category') == 'category_5') {
            if ($request->filled('price_from') or $request->filled('price_to')) {
                price($request, $skateQuery);
            } else {
                return redirect()->route('skates_base.index');
            }
        }

        $skatesFromBase = $skateQuery->paginate(8)->withQueryString();
        return view('skates', ['skatesFromBase' => $skatesFromBase, 'quantity' => $quantity]);

    }
}
