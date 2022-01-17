<?php

namespace App\Http\Controllers;
use App\Models\Skate;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;

class SkateFromDbController extends Controller


{
    public function index()
    {
        $skatesFromBase = Skate::paginate(8);
        $quantity = count(Skate::all());
        return view('skates', compact('skatesFromBase', 'quantity'));
    }

    public function create()
    {
        return view('new_skate');
    }

    public function store(Request $request)
    {
        $user = auth()->user();//get current user
        $skates = new Skate;
        $skates::create([
            'external_id' => 'NULL',
            'name' => $request['name'],
            'description' => $request['description'],
            'img' => $request['img'],
            'price' => $request['price'],
            'category_id' => $request['category_id'],
            'user_id' => $user->id,//current user id
        ]);

        $created_name = $request['name'];
        return redirect('http://boardburg.xx/skates-from-base')->with('success', 'Был создан товар с названием: ' . $created_name);
    }


    public function edit($id)
    {

        $skateFromBase = Skate::all()->where('id', $id)->first();
        return view('edit_skate',compact('skateFromBase'));
    }

    public function update(Request $request, $id):RedirectResponse
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




    public function show($id)
    {
        $skateFromBase = Skate::all()->where('id',$id)->first();
        return view('skate',['skateFromBase' => $skateFromBase, 'previous_url' => URL::previous()] );
    }




    public function destroy(Skate $skate, $id)
    {
        $skateFromBase = $skate::find($id);
        if ($skateFromBase->delete()){
            return redirect('skates-from-base')->with('success', "Товар с ID $id был удален");
        }else{
            return redirect('skates-from-base')->with('success', "Товар с ID $id не был удален");
        }
     }
}
