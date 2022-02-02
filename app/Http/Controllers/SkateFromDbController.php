<?php

namespace App\Http\Controllers;

use App\Models\Skate;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

use Illuminate\Support\Facades\URL;

class SkateFromDbController extends Controller
{
    public function index(Skate $skate)
    {

        $authCheck = Auth::check();
        $skates = $skate::query();
        $quantity = $skates->count();
        $skatesFromBase = selectManagers(roleCheck(auth()->user(), $authCheck), $skates, auth()->user());
        return view('skates', compact('skatesFromBase', 'quantity'));
    }

    public function create()
    {
        return view('new_skate');
    }

    public function store(Request $request)
    {
        $skates = new Skate;
        if (!empty(auth()->user()->id)) {
            $skates::create(array(
                'external_id' => 'NULL',
                'name' => $request['name'],
                'description' => $request['description'],
                'img' => $request['img'],
                'price' => $request['price'],
                'category_id' => $request['category_id'],
                'user_id' => auth()->user()->id,
            ));
        }
        $created_name = $request['name'];
        return redirect('skates-from-base')->with('success', 'Был создан товар с названием: ' . $created_name);
    }

    public function edit(Skate $skate, $id)
    {
        $skateFromBase = $skate::all()->find($id);
        Gate::authorize('update-skate', [$skateFromBase]);
        return view('edit_skate', compact('skateFromBase'));
    }

    public function update(Request $request, Skate $skate, $id): RedirectResponse
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'img' => 'required',
            'price' => 'required',
            'category_id' => 'required'
        ]);
        $skateFromBase = $skate::all()->find($id);
        Gate::authorize('update-skate', [$skateFromBase]);
        $skateFromBase->update($request->all());
        return redirect()->route('skates_base.index')->with('success', "Обновлен товар: {$request['name']}");


//        $urls = array();
//        if (Session::has('links')) {
//            $urls[] = Session::get('links');
//        }
//
//       $currentUrl = $_SERVER['REQUEST_URI'];
//
//        array_unshift($urls, $currentUrl);
//        Session::flash('urls', $urls);
//
//        $links = Session::get('urls');
//
//        return Redirect::back()->with('success', "Обновлен товар: {$request['name']}");
    }

    public function show(Skate $skate, $id)
    {
        $skateFromBase = $skate::all()->where('id', $id)->first();
        return view('skate', ['skateFromBase' => $skateFromBase, 'previous_url' => URL::previous()]);
    }

    public function destroy(Skate $skate, $id)
    {
        $skateFromBase = $skate->all()->find($id);
        Gate::authorize('delete-skate', [$skateFromBase]);
        $skateFromBase->delete();
        return redirect('skates-from-base')->with('success', "Товар с ID $id был удален");
    }
}
