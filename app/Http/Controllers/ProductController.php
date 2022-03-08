<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\TemporaryFile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\URL;
use App\Http\Requests\StoreSkateRequest;

class ProductController extends Controller
{
    public function index(Product $product, Request $request, Session $session)
    {
        forgetOldVariablesFromSession($session);
        putQueryInSession($request, $session);
        $productFromBase = selectWhatShowToUser(roleCheck(auth()->user(), Auth::check()), $product::query(), auth()->user());
        $quantity = $productFromBase->count();
        $productsFromBase = $productFromBase->paginate(8);
        putLastPageInSession($productsFromBase, $session);
        if (!$productsFromBase->count()) {
            return redirect()->route('skates_base.index', ['page' => $productsFromBase->lastPage()]);
        }
        return view('home', compact('productsFromBase', 'quantity'));
    }













    public function create()
    {
        return view('skates.skate_new');
    }

    public function store(StoreSkateRequest $request, Session $session): RedirectResponse
    {
        if (!empty(auth()->user()->id)) {
            $skate = Product::create([
                'external_id' => 'NULL',
                'name' => $request['name'],
                'description' => $request['description'],
                'price' => $request['price'],
                'category_id' => $request['category_id'],
                'user_id' => auth()->user()->id,
                'slug' => slugDefining($request['category_id']),
                'img' => ' '
            ]);
        }
        $temporaryFile = TemporaryFile::where('folder', $request['cover'])->first();
        if ($temporaryFile) {
            tmpFileAddToMediaLibrary($request, $skate, $temporaryFile);
        }
        $created_name = $request['name'];
        $authCheck = Auth::check();
        $skatesFromBase = selectWhatShowToUser(roleCheck(auth()->user(), $authCheck), $skate, auth()->user())->paginate(8);
        $quantity = count($skatesFromBase->all()) + 1;
        return redirect()->route('skates_base.index', getLastPageFromSession($session, $quantity))->with('success', 'Был создан товар с названием: ' . $created_name);
    }

    public function edit(Product $skate, $id)
    {
        $skateFromBase = $skate::all()->find($id);
        Gate::authorize('update-skate', [$skateFromBase]);
        return view('skates.skate_edit', compact('skateFromBase'));
    }

    public function update(StoreSkateRequest $request, Product $skate, Session $session): RedirectResponse
    {
        $inputs = $request->all();
        $inputs['slug'] = slugDefining($request['category_id']);
        Gate::authorize('update-skate', [$skate]);
        $temporaryFile = TemporaryFile::where('folder', $request['cover'])->first();// from tmp base
        $baseFilename = cut_string_using_last('/', $skate['img'], 'right', false); // from skate base
        if ($temporaryFile != $baseFilename) {
            tmpFileAddToMediaLibrary($request, $skate, $temporaryFile);
        }
        $skate->fill($inputs);
        $skate->save();
        return redirect()->route('skates_base.index', getOldQueryFromSession($session))->with('success', "Обновлен товар: {$request['name']}");
    }

    public function show(Product $skate, $id)
    {
        $skateFromBase = $skate::all()->where('id', $id)->first();
        return view('skates.skate', ['skateFromBase' => $skateFromBase, 'previous_url' => URL::previous()]);
    }

    public function destroy(Product $skate, $id, Session $session): RedirectResponse
    {
        if ($skate->count() > 1) {
            $skatesFromBase = $skate->all();
            $skateFromBase = $skatesFromBase->find($id);
            Gate::authorize('delete-skate', [$skateFromBase]);
            $shortImgName = cut_string_using_last('/', $skateFromBase['img'], 'right', false);
            $baseImgNameWithoutExtension = extensionRemover($shortImgName);
            removeFileFromUploads([$baseImgNameWithoutExtension, getExtension($shortImgName)], '-thumb'); //converted file
            removeFolderFromUploads($baseImgNameWithoutExtension, true); //folder with converted file
            removeFileFromUploads([$baseImgNameWithoutExtension, getExtension($shortImgName)], null); //base file
            removeFolderFromUploads($baseImgNameWithoutExtension, false);
            removeRecordInMediaTable($skate, $shortImgName);
            $skateFromBase->delete();
            return redirect()->route('skates_base.index', getOldQueryFromSession($session))->with('success', "Товар с ID $id был удален");

        }
        return redirect()->back()->with('success', "Последний товар не может быть удален.");
    }
}
