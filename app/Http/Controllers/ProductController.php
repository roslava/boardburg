<?php

namespace App\Http\Controllers;

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
    public function index(Product $product, Request $request, Session $session, User $user)
    {
        forgetOldVariablesFromSession($session);
        putQueryInSession($request, $session);
        $productFromBase = selectWhatShowToUser($user::roleCheck(auth()->user(), Auth::check()), $product::query(), auth()->user());
        $quantity = $productFromBase->count();
        $productsFromBase = $productFromBase->paginate(8);
        putLastPageInSession($productsFromBase, $session);
        if (!$productsFromBase->count()) {
            return redirect()->route('products_base.index', ['page' => $productsFromBase->lastPage()]);
        }
        return view('home', compact('productsFromBase', 'quantity'));
    }

    public function create()
    {
        return view('products.product_new');
    }

    public function store(StoreProductRequest $request, Session $session, ImgUploadService $imgUploadService, User $user): RedirectResponse
    {

        if (!empty(auth()->user()->id)) {
            $product = Product::create([
                'external_id' => 'NULL',
                'name' => $request['name'],
                'description' => $request['description'],
                'price' => $request['price'],
                'category_id' => $request['category_id'],
                'user_id' => auth()->user()->id,
                'slug' => Product::getSlug($request['category_id']),
                'img' => ' '
            ]);
        }

        $imgUploadService->tmpFileAddToMediaLibrary($request, $product);
        $created_name = $request['name'];
        $authCheck = Auth::check();
        $productsFromBase = selectWhatShowToUser($user::roleCheck(auth()->user(), $authCheck), $product, auth()->user())->paginate(8);
        $quantity = count($productsFromBase->all()) + 1;
        return redirect()->route('products_base.index', getLastPageFromSession($session, $quantity))->with('success', 'Был создан товар с названием: ' . $created_name);
    }

    public function edit(Product $product, $id)
    {
        $productFromBase = $product::all()->find($id);
        Gate::authorize('update-product', [$productFromBase]);
        return view('products.product_edit', compact('productFromBase'));
    }

    public function update(StoreProductRequest $request, Product $product, Session $session,  ImgUploadService $imgUploadService): RedirectResponse
    {
        $inputs = $request->all();
        $inputs['slug'] = $product::getSlug($request['category_id']);
        Gate::authorize('update-product', [$product]);
        $imgUploadService->tmpFileAddToMediaLibrary($request, $product);
        $product->fill($inputs);
        $product->save();
        return redirect()->route('products_base.index', getOldQueryFromSession($session))->with('success', "Обновлен товар: {$request['name']}");
    }

    public function show(Product $product, $id)
    {
        $productFromBase = $product::all()->where('id', $id)->first();
        return view('products.product', ['productFromBase' => $productFromBase, 'previous_url' => URL::previous()]);
    }

    public function destroy(Product $product, $id, Session $session): RedirectResponse
    {
        if ($product->count() > 1) {
            $productsFromBase = $product->all();
            $productFromBase = $productsFromBase->find($id);
            Gate::authorize('delete-product', [$productFromBase]);
            $shortImgName = cut_string_using_last('/', $productFromBase['img'], 'right', false);
            $baseImgNameWithoutExtension = extensionRemover($shortImgName);
            removeFileFromUploads([$baseImgNameWithoutExtension, getExtension($shortImgName)], '-thumb'); //converted file
            removeFolderFromUploads($baseImgNameWithoutExtension, true); //folder with converted file
            removeFileFromUploads([$baseImgNameWithoutExtension, getExtension($shortImgName)], null); //base file
            removeFolderFromUploads($baseImgNameWithoutExtension, false);
            removeRecordInMediaTable($product, $shortImgName);
            $productFromBase->delete();
            return redirect()->route('products_base.index', getOldQueryFromSession($session))->with('success', "Товар с ID $id был удален");
        }
        return redirect()->back()->with('success', "Последний товар не может быть удален.");
    }
}
