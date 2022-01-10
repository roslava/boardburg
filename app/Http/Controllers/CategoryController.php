<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Skate;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $skateQuery = Skate::query(); // метод query()

        if ($request->filled('price_from')) {
            $skateQuery->where('price', '>=', $request->price_from);
        }
        if ($request->filled('price_to')) {
            $skateQuery->where('price', '<=', $request->price_to);
        }

        if ($request->input('category') == 'category_1') {
            $skateQuery->where('category_id', 1);
        }

        if ($request->input('category') == 'category_2') {
            $skateQuery->where('category_id', 2);
        }

        if ($request->input('category') == 'category_3') {
            $skateQuery->where('category_id', 3);
        }

        if ($request->input('category') == 'category_4') {
            $skateQuery->where('category_id', 4);
        }

        if ($request->input('category') == 'category_5') {
            $skateQuery->where('category_id', '>', 0);

        }


        $skatesFromBase = $skateQuery->paginate(1)->withQueryString();

         return view('home', ['skatesFromBase'=>$skatesFromBase]);

//return view('home', compact('skatesFromBase'))->withPath("?".$request->getQueryString());

    }
}
