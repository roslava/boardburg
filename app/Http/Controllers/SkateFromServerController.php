<?php

namespace App\Http\Controllers;

use App\Models\Skate;
use Illuminate\Support\Facades\Http;


class SkateFromServerController extends Controller
{
    public function index()
    {
        return Http::get('http://boardburger-api-v1.com/skates.json')->json();
    }

    public function store($skateFromServer)
    {
        $skates = new Skate;
        $skates::create([
            'external_id' => $skateFromServer['id'],
            'name' => $skateFromServer['name'],
            'description' => $skateFromServer['description'],
            'img' => $skateFromServer['img'],
            'price' => $skateFromServer['price'],
            'category_id' => $skateFromServer['category_id'],
            'user_id' => $skateFromServer['user_id'],
        ]);
    }

    public function update($skateFromServer, $id)
    {
        Skate::where('external_id', $id)->update([
            'name' => $skateFromServer['name'],
            'description' => $skateFromServer['description'],
            'img' => $skateFromServer['img'],
            'price' => $skateFromServer['price'],
            'category_id' => $skateFromServer['category_id'],
            'user_id' => $skateFromServer['user_id'],
        ]);
    }
}
