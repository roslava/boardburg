<?php

namespace App\Http\Controllers;

use App\Models\Skate;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\URL;
use App\Http\Requests\StoreSkateRequest;

class SkateFromDbController extends Controller
{
    public function index(Skate $skate, Request $request, Session $session)
    {
//        dd($request);

        removeOldVariablesFromSession($session); //helper — forget all variables in session
        putQueryInSession($request, $session); //helper — puts current query in session
        $skatesFromBase = selectWhatShowToUser(roleCheck(auth()->user(), Auth::check()), $skate::query(), auth()->user());
        $quantity = $skatesFromBase->count();
        $skatesFromBase = $skatesFromBase->paginate(8);
        putLastPageInSession($skatesFromBase, $session); //helper — puts lastPage in session
        if (!$skatesFromBase->count()) {
            return redirect()->route('skates_base.index', ['page' => $skatesFromBase->lastPage()]);
        }
        return view('home', compact('skatesFromBase', 'quantity'));
    }

    public function create()
    {
        return view('skates.skate_new');
    }

    public function store(StoreSkateRequest $request, Session $session): RedirectResponse
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
        $authCheck = Auth::check();
        $skatesFromBase = selectWhatShowToUser(roleCheck(auth()->user(), $authCheck), $skates, auth()->user())->paginate(8);
        $quantity = count($skatesFromBase->all()) + 1;
//       dd($request);
        return redirect()->route('skates_base.index', getLastPageFromSession($session, $quantity))->with('success', 'Был создан товар с названием: ' . $created_name);
    }

    public function edit(Skate $skate, $id)
    {
        $skateFromBase = $skate::all()->find($id);
        Gate::authorize('update-skate', [$skateFromBase]);
        return view('skates.skate_edit', compact('skateFromBase'));
    }

    public function update(Request $request, Skate $skate, $id, Session $session): RedirectResponse
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
        return redirect()->route('skates_base.index', getOldQueryFromSession($session))->with('success', "Обновлен товар: {$request['name']}");
    }

    public function show(Skate $skate, $id)
    {
        $skateFromBase = $skate::all()->where('id', $id)->first();
        return view('skates.skate', ['skateFromBase' => $skateFromBase, 'previous_url' => URL::previous()]);
    }

    public function destroy(Skate $skate, $id): RedirectResponse
    {
        $skatesFromBase = $skate->all();
        $skateFromBase = $skatesFromBase->find($id);
        Gate::authorize('delete-skate', [$skateFromBase]);
        $skateFromBase->delete();
        return redirect()->back()->with('success', "Товар с ID $id был удален");
    }
}
