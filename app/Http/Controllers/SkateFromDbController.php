<?php

namespace App\Http\Controllers;

use App\Models\Skate;
use App\Models\TemporaryFile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\URL;
use App\Http\Requests\StoreSkateRequest;
use Intervention\Image\Facades\Image;


class SkateFromDbController extends Controller
{
    public function index(Skate $skate, Request $request, Session $session)
    {
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

//$id, Image $image,

    public function store(StoreSkateRequest $request, Session $session): RedirectResponse
    {
        $skate = new Skate;
        if (!empty(auth()->user()->id)) {
            $skate::create(array(
                'external_id' => 'NULL',
                'name' => $request['name'],
                'description' => $request['description'],
                'price' => $request['price'],
                'category_id' => $request['category_id'],
                'user_id' => auth()->user()->id,
                'slug' => slugDefining($request['category_id']),
                'img' => ' ',
            ));
        }

        $temporaryFile = TemporaryFile::where('folder', $request->cover)->first();
        if ($temporaryFile) {
            $folder = 'app/public/tmp/' . $request->cover;
            $media = $skate->first()->addMedia(storage_path($folder . '/' . $temporaryFile->filename))
                ->toMediaCollection('cover');
            rmdir(storage_path($folder));
            $temporaryFile->delete();
            dd($media->getUrl('thumb'));
        } else {
            dd('Нет темпфайла');
        }

        $created_name = $request['name'];
        $authCheck = Auth::check();
        $skatesFromBase = selectWhatShowToUser(roleCheck(auth()->user(), $authCheck), $skate, auth()->user())->paginate(8);
        $quantity = count($skatesFromBase->all()) + 1;

        return redirect()->route('skates_base.index', getLastPageFromSession($session, $quantity))->with('success', 'Был создан товар с названием: ' . $created_name);
    }

    public function edit(Skate $skate, $id)
    {
        $skateFromBase = $skate::all()->find($id);
        Gate::authorize('update-skate', [$skateFromBase]);
        return view('skates.skate_edit', compact('skateFromBase'));
    }

    public function update(Image $image, StoreSkateRequest $request, Skate $skate, $id, Session $session): RedirectResponse
    {
        dd($request);
        $skateFromBase = $skate::all()->find($id);
        $skateFromBase->external_id = 'NULL';
        $skateFromBase->name = $request->get('name');
        $skateFromBase->description = $request->get('description');
        $skateFromBase->price = $request->get('price');
        $skateFromBase->category_id = $request->get('category_id');
        $skateFromBase->user_id = auth()->user()->id;
        $skateFromBase->slug = slugDefining($request['category_id']);
        $skateFromBase->img = setImgPath($request, $image, slugDefining($request['category_id']));
        $skateFromBase->save();
        Gate::authorize('update-skate', [$skateFromBase]);
//        $skateFromBase->update($request->all());
//dd($skateFromBase->img);
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
        $directory = cut_string_using_last('/', $skateFromBase['img'], 'left', true);
        Storage::disk('public')->deleteDirectory($directory);
        $skateFromBase->delete();
        return redirect()->back()->with('success', "Товар с ID $id был удален");
    }
}

