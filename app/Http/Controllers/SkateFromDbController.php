<?php

namespace App\Http\Controllers;
use App\Models\Skate;
use Illuminate\Support\Facades\URL;

class SkateFromDbController extends Controller


{
    public function index()
    {
        $skatesFromBase = Skate::paginate(8);
        $quantity = count(Skate::all());
        return view('skates', compact('skatesFromBase', 'quantity'));
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
            'user_id' => 0,
        ]);
    }

    public function show($id)
    {
        $skateFromBase = Skate::all()->where('id',$id)->first();
        return view('skate',['skateFromBase' => $skateFromBase, 'previous_url' => URL::previous()] );
    }


    public function update($skateFromServer, $id)
    {
        Skate::where('external_id', $id)->update([
            'name' => $skateFromServer['name'],
            'description' => $skateFromServer['description'],
            'img' => $skateFromServer['img'],
            'price' => $skateFromServer['price'],
            'category_id' => $skateFromServer['category_id'],
        ]);
    }


    public function destroy(Skate $skate, $id)
    {
        $skateFromBase = $skate::find($id);
        $this->authorize('delete', $skateFromBase);
//        $skateFromBase->delete();

        if ($skateFromBase->delete()){
            return redirect('skates-from-base')->with('success', "Товар с ID $id был удален");
        }else{
            return redirect('skates-from-base')->with('success', "Товар с ID $id не был удален");
        }
     }
}
