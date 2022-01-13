<?php

namespace App\Http\Controllers;

use App\Models\Skate;
use App\Models\User;
use Illuminate\Http\Request;

class SkateFromForm extends Controller
{

    public function create()
    {
        return view('new_skate');
    }


    public function store(Request $request, User $user)
    {
        $skates = new Skate;
        $skates::create([
            'external_id' => 'NULL',
            'name' => $request['name'],
            'description' => $request['description'],
            'img' => $request['img'],
            'price' => $request['price'],
            'category_id' => $request['category_id'],
            'user_id' => 0,

        ]);

//        dd($user->au);
        $created_name = $request['name'];
        return redirect('http://boardburg.xx/skates-from-base')->with('success', 'Был создан товар с названием: ' . $created_name);
    }


    public function edit($id)
    {
        $skateFromBase = Skate::all()->where('id',$id)->first();
        return view('edit_skate',compact('skateFromBase'));
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'name' =>'required',
            'description'=>'required',
            'img'=>'required',
            'price'=>'required',
            'category_id'=>'required'

             ]);

        $skate=Skate::all()->find($id);
        $skate->update($request->all());

        $created_name = $request['name'];
        return redirect()->route('skates_base.index')->with('success', "Обновлен товар: $created_name");
    }


//Более громоздкий вариант — тоже работает
    //    public function update(Request $request, $id)
//    {
//        $request->validate([
//            'name' =>'required',
//            'description'=>'required',
//            'img'=>'required',
//            'price'=>'required',
//            'category_id'=>'required'
//             ]);
//
//        $skate = Skate::find($id);
//        $skate->name = $request['name'];
//        $skate->description = $request['description'];
//        $skate->img = $request['img'];
//        $skate->price = $request['price'];
//        $skate->category_id = $request['category_id'];
//        $skate->save();
//
//        $created_name = $request['name'];
//        return redirect()->route('skates_base.index')->with('success', "Обновлен товар: $created_name");
//    }
}
