<?php

namespace App\Http\Controllers;

use App\Models\Skate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Http;


class SkateFromServerController extends Controller
{

    public function index()
    {
        return $skates_from_server = Http::get('http://boardburger-api-v1.com/skates.json')->json();

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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









    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
