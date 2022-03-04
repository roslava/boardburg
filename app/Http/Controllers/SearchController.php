<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Skate;
use Illuminate\Support\Facades\Auth;

class SearchController extends Controller
{
    public function search(Request $request, Skate $skate)
    {
        $search = $request['search_input_bb'];
        if(!auth::check() || !Auth::user()->isAdmin()) if (Auth::check() && auth()->user()['role'] === 'manager') {
            $currentUserId = auth()->user()['id'];
            $skatesFromBaseQuery = $skate->query()->where('user_id', '=', $currentUserId)->where('name', 'LIKE', "%$search%");
            $quantity = count($skatesFromBaseQuery->get());
            $skatesFromBase = $skatesFromBaseQuery->orderBy('name')->paginate(8)->withQueryString();
        } else {
            $skatesFromBaseQuery = $skate::query()->where('name', 'LIKE', "%$search%");
            $quantity = count($skatesFromBaseQuery->get());
            $skatesFromBase = $skatesFromBaseQuery->orderBy('name')->paginate(8)->withQueryString();
        } else {
            $skatesFromBaseQuery = $skate::query()->where('name', 'LIKE', "%$search%");
            $quantity = count($skatesFromBaseQuery->get());
            $skatesFromBase = $skatesFromBaseQuery->orderBy('name')->paginate(8)->withQueryString();
        }
        return view('home', compact('skatesFromBase', 'quantity', 'search'));
    }
}
