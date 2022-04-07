<?php

namespace App\Http\Controllers;

use App\Models\Product;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CartController extends Controller

{
    public function index(Product $product)
    {

        $cart = \Cart::session(\Illuminate\Support\Facades\Session::getId())->getContent();
        $sum = \Cart::getTotal('price');
        return view('cart.index', compact('cart', 'sum'));

    }

    public function addToCart(Request $request, Product $product)
    {
        $currentProduct = $product->query()->where('id', $request['id'])->first();
        $currentProductName = $currentProduct->name;
        $sessionId = Session::getId();
        $cart = \Cart::getContent();

        if (!\Cart::session($sessionId)->getContent()->where('id', $request['id'])->first()) {
            \Cart::session($sessionId)->add([
                'id' => $currentProduct['id'],
                'name' => $currentProduct['name'],
                'price' => $currentProduct['price'],
                'quantity' => $request->qty ?? 1,
                'attributes' => ['image' => $currentProduct['img']],
            ]);

           $isAddedToCartMessage = $this::confirmation(true, $currentProductName);
        }else{
            $isAddedToCartMessage =  $this::confirmation(false, $currentProductName);
        }


        $totalQuantity = \Cart::session($sessionId)->getTotalQuantity();
        return compact('cart', 'totalQuantity', 'isAddedToCartMessage');
    }

    public function remove(Request $request)
    {
        $sessionId = Session::getId();
        \Cart::session($sessionId)->remove($request->id);
        return redirect()->route('cart.index')->with('success', 'Item Cart Remove Successfully !');
    }


    private static function confirmation($isAdded, $currentProductName)
    {
        if ($isAdded) {
           return ['isAddedToCartMessage' => "В корзину добавлен товар: $currentProductName"];
        }else{
            return ['isAddedToCartMessage' => 'Этот товар уже находится в корзине'];
        }
    }
}
