<?php

namespace App\Http\Controllers;

use App\Helpers;
use App\Models\Product;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\URL;
use App\Http\Requests\StoreProductRequest;
use App\Services\ImgUploadService;

class ProductController extends Controller
{
    public function index(Product $product, Request $request, Session $session)
    {
        if ($session::has('oldQuery')) $session::forget('oldQuery');
        if ($session::has('lastPageIs')) $session::forget('lastPageIs');
        $session::put('oldQuery', $request->query);

        if (User::isManager(auth()->user(), Auth::check())) {
            $productFromBase = $product::query()->where('user_id', '=', auth()->user()['id']);
        } else {
            $productFromBase = $product;
        }

        $quantity = $productFromBase->count();
        $productsFromBase = $productFromBase->paginate(8);
        $session::put('lastPageIs', $productsFromBase->lastPage());

        if (!$productsFromBase->count()) {
            return redirect()->route('products_base.index', ['page' => $productsFromBase->lastPage()]);
        }
        return view('home', compact('productsFromBase', 'quantity'));
    }

    public function create()
    {
        return view('products.product_new');
    }

    public function store(Product $product, StoreProductRequest $request, Session $session, ImgUploadService $imgUploadService): RedirectResponse
    {
        if (!empty(auth()->user()['id'])) {
            $inputs = $request->all();
            $inputs['external_id'] = 'NULL';
            $inputs['slug'] = $product::getSlug($request['category_id']);
            $inputs['user_id'] = auth()->user()['id'];
            $inputs['img'] = ' ';
            $product->fill($inputs);
            $product->save();
        }

        $imgUploadService::tmpFileAddToMediaLibrary($request, $product);
        $created_name = $request['name'];

        if (User::isManager(auth()->user(), Auth::check())) {
            $productsFromBase = $product::query()->where('user_id', '=', auth()->user()['id'])->paginate(8);
        } else {
            $productsFromBase = $product;
        }

        $quantity = count($productsFromBase->all()) + 1;

        function getLastPageFromSession($session, $quantity): array
        {
            if ($quantity % 8 === 1) {
                $page = $session::get('lastPageIs') + 1;
                return compact('page');
            }
            $page = $session::get('lastPageIs');
            return compact('page');
        }

        return redirect()->route('products_base.index',
            getLastPageFromSession($session, $quantity))
            ->with('success', 'Был создан товар с названием: ' . $created_name);
    }

    public function edit(Product $product, $id)
    {
        $productFromBase = $product::all()->find($id);
        Gate::authorize('update-product', [$productFromBase]);
        return view('products.product_edit', compact('productFromBase'));
    }

    public function update(StoreProductRequest $request, Product $product, Session $session, ImgUploadService $imgUploadService): RedirectResponse
    {
        $inputs = $request->all();
        $inputs['slug'] = $product::getSlug($request['category_id']);
        Gate::authorize('update-product', [$product]);
        $imgUploadService->tmpFileAddToMediaLibrary($request, $product);
        $product->fill($inputs);
        $product->save();
        return redirect()->route('products_base.index', self::getOldQueryFromSession($session))->with('success', "Обновлен товар: {$request['name']}");
    }

    public function show(Product $product, $id)
    {
        $productFromBase = $product::all()->where('id', $id)->first();
        return view('products.product', ['productFromBase' => $productFromBase, 'previous_url' => URL::previous()]);
    }

    public function destroy(Product $product, $id, Session $session): RedirectResponse
    {
        if ($product::query()->count() > 1) {
            $productsFromBase = $product->all();
            $productFromBase = $productsFromBase->find($id);
            Gate::authorize('delete-product', [$productFromBase]);
            $shortImgName = Helpers::cutString('/', $productFromBase['img'], 'right', false);
            $baseImgNameWithoutExtension = Helpers::removeExtension($shortImgName);
            ImgUploadService::removeFileFromUploads([$baseImgNameWithoutExtension, Helpers::getExtension($shortImgName)], '-thumb'); //converted file
            ImgUploadService::removeFolderFromUploads($baseImgNameWithoutExtension, true); //folder with converted file
            ImgUploadService::removeFileFromUploads([$baseImgNameWithoutExtension, Helpers::getExtension($shortImgName)]); //base file
            ImgUploadService::removeFolderFromUploads($baseImgNameWithoutExtension, false);
            $mediaItems = $product::query()->first()->getMedia('cover');
            $mediaItem = $mediaItems->where('file_name', '=', $shortImgName)->first();
            if ($mediaItem) $mediaItem->delete();
            $productFromBase->delete();
            return redirect()->route('products_base.index', self::getOldQueryFromSession($session))->with('success', "Товар с ID $id был удален");
        }
        return redirect()->back()->with('success', "Последний товар не может быть удален.");
    }

    private static function getOldQueryFromSession($session)
    {
        $value = $session::get('oldQuery');
        return current($value);
    }
}
