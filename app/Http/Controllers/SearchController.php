<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Skate;
use Illuminate\Support\Facades\Auth;

class SearchController extends Controller
{
    public function search(Request $request, Skate $skate)
    {
        $search = $request->search_input;

        if(Auth::check() && Auth::user()->isAdmin()) {
            $skatesFromBaseQuery = $skate::query()->where('name', 'LIKE', "%{$search}%");
            $quantity = count($skatesFromBaseQuery->get());
            $skatesFromBase = $skatesFromBaseQuery->orderBy('name')->paginate(8)->withQueryString();
        }elseif (Auth::check() && auth()->user()->role ==='manager'){
            $currentUserId = auth()->user()->id;
            $skatesFromBaseQuery = $skate->query()->where('user_id','=', $currentUserId)->where('name', 'LIKE', "%{$search}%");
            $quantity = count($skatesFromBaseQuery->get());
            $skatesFromBase = $skatesFromBaseQuery->orderBy('name')->paginate(8)->withQueryString();
        }else{
            $skatesFromBaseQuery = $skate::query()->where('name', 'LIKE', "%{$search}%");
            $quantity = count($skatesFromBaseQuery->get());
            $skatesFromBase = $skatesFromBaseQuery->orderBy('name')->paginate(8)->withQueryString();
        }

        return view('skates', compact('skatesFromBase', 'quantity', 'search'));

    }
}
