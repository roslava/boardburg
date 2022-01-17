<?php

namespace App\Http\Controllers;
use App\Models\Skate;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;

class SkateFromDbController extends Controller


{
    public function index(User $user, Skate $skate)
    {
        $quantity = count(Skate::all());

        If(Auth::check() && Auth::user()->isAdmin()) {
            $skatesFromBase = Skate::paginate(8);
            return view('skates', compact('skatesFromBase', 'quantity'));
        }elseif (Auth::check() && auth()->user()->role ==='guest'){
            $skatesFromBase = Skate::paginate(8);
            return view('skates', compact('skatesFromBase', 'quantity'));
        }else{
            $currentUserId = auth()->user()->id;
            $skatesFromBase = $skate->where('user_id','=', $currentUserId )->paginate(8);
        }
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
        $skateFromBase=Skate::all()->find($id);
//        $skateFromBase = Skate::all()->where('id', $id)->first();
        Gate::authorize('update-skate', [$skateFromBase]);
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

        $skateFromBase=Skate::all()->find($id);
        Gate::authorize('update-skate', [$skateFromBase]);
        $skateFromBase->update($request->all());

        $created_name = $request['name'];
        return redirect()->route('skates_base.index')->with('success', "Обновлен товар: $created_name");
    }




    public function show($id)
    {
        $skateFromBase = Skate::all()->where('id',$id)->first();
        return view('skate',['skateFromBase' => $skateFromBase, 'previous_url' => URL::previous()] );
    }




    public function destroy($id)
    {
        $skateFromBase=Skate::all()->find($id);
        Gate::authorize('delete-skate', [$skateFromBase]);
        if ($skateFromBase->delete()){
            return redirect('skates-from-base')->with('success', "Товар с ID $id был удален");
        }else{
            return redirect('skates-from-base')->with('success', "Товар с ID $id не был удален");
        }
     }
}
