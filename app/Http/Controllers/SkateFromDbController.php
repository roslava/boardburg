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

    public function store(StoreSkateRequest $request, Session $session): RedirectResponse
    {
        $skate = new Skate;


        $temporaryFile = TemporaryFile::where('folder', $request->cover)->first();
        if ($temporaryFile) {
            $folder = 'app/public/tmp/' . $request->cover;
//        dd($folder);
            $slug = slugDefining($request['category_id']);
            $singular_slug = substr($slug, 0, -1);
            $unic = now()->timestamp;
//            storage_path('app/public')
//            dd(storage_path($folder . '/' . $temporaryFile->filename));

//dd($skate->first());
            $media = $skate->first()->addMedia(storage_path($folder . '/' . $temporaryFile->filename))
                ->usingFileName($singular_slug . '_' . $unic . '.jpg')
                ->toMediaCollection('cover');


            rmdir(storage_path($folder));
            $temporaryFile->delete();
//            dd(extensionRemoer($media->file_name).'/'.$media->file_name);
//            dd(Storage::disk('public'));

//            Storage::disk('public')->url('users/'. Auth::user()->image)
//           $media = $skate   dd($media->getFullUrl());
//        dd($media->getUrl());

        } else {
            dd('Нет темпфайла');
        }

//        /Users/sea/Documents/#WEBDEV/php_projects/boardburg/storage/app/public/uploads/bearing_1645184991/bearing_1645184991.jpg










        if (!empty(auth()->user()->id)) {
            $skate::create(array(
                'external_id' => 'NULL',
                'name' => $request['name'],
                'description' => $request['description'],
                'price' => $request['price'],
                'category_id' => $request['category_id'],
                'user_id' => auth()->user()->id,
                'slug' => slugDefining($request['category_id']),
                'img' => extensionRemoer($media->file_name).'/'.$media->file_name
            ));
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
        return redirect()->route('skates_base.index', getOldQueryFromSession($session))->with('success', "Обновлен товар: {$request['name']}");
    }

    public function show(Skate $skate, $id)
    {
        $skateFromBase = $skate::all()->where('id', $id)->first();
        return view('skates.skate', ['skateFromBase' => $skateFromBase, 'previous_url' => URL::previous()]);
    }

    public function destroy(Skate $skate, $id): RedirectResponse
    {
        if($skate->count() > 1){

        $skatesFromBase = $skate->all();
        $skateFromBase = $skatesFromBase->find($id);
        Gate::authorize('delete-skate', [$skateFromBase]);
        $directory = cut_string_using_last('/', $skateFromBase['img'], 'left', false);
//        Storage::exists('uploads/'.$directory)?'да': 'нет';
        $shortImgName = cut_string_using_last('/', $skateFromBase['img'], 'right', false);


        $shortImgNameWithoutExtension =  extensionRemoer($shortImgName);
        $getExtension = explode( '.', $shortImgName );
        $extension = end( $getExtension);

        // удаление конвертированного файла из папки conversions
        if (file_exists(storage_path('app/public/uploads/'. $directory . '/conversions/'. $shortImgNameWithoutExtension . '-thumb' .'.'.$extension)) AND $skateFromBase->id == $id){
            unlink(storage_path('app/public/uploads/'. $directory . '/conversions/'. $shortImgNameWithoutExtension . '-thumb' .'.'.$extension ));
        }
        // удаление папки conversions
        if(is_dir(storage_path('app/public/uploads/'.$directory.'/conversions')) AND $skateFromBase->id == $id){
            rmdir(storage_path('app/public/uploads/'.$directory.'/conversions'));
        }
//        dd(storage_path('app/public/uploads/'. $skateFromBase['img']));
// удаление файла
if (file_exists(storage_path('app/public/uploads/'. $skateFromBase['img'])) AND $skateFromBase->id == $id){

    unlink(storage_path('app/public/uploads/'. $skateFromBase['img'])); // удаление основного файла
}

// удаление папки
        if(is_dir(storage_path('app/public/uploads/'.$directory)) AND $skateFromBase->id == $id){
            rmdir(storage_path('app/public/uploads/'.$directory));
        }
        removeRecordInMediaTable($skate, $shortImgName);

    if ($skateFromBase) {
        $skateFromBase->delete();
        return redirect()->back()->with('success', "Товар с ID $id был удален");
    }
        }
        return redirect()->back()->with('success', "Последний товар не может быть удален.");
    }

}

