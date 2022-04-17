<?php

namespace App\Http\Controllers;

use App\Models\Product;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CartController extends Controller

{
    public function index()
    {
        return view('cart.index');
    }


    public function render(\Cart $cart): array
    {
        $sessionId = Session::getId();
        $cartItems = $cart::session($sessionId)->getContent();
        $sum = $cart::getTotal('price');
        return compact('cartItems', 'sum');
    }


    public function addToCart(Request $request, \Cart $cart, Product $product): array
    {
        $currentProduct = $product->query()->where('id', $request['id'])->first();
        $currentProductName = $currentProduct->name;
        $sessionId = Session::getId();
        $cartItem = $cart::getContent();

        if (!$this::getProductFromSession($request)) {
            $cart::session($sessionId)->add([
                'id' => $currentProduct['id'],
                'name' => $currentProduct['name'],
                'price' => $currentProduct['price'],
                'quantity' => $request->qty ?? 1,
                'attributes' => ['image' => $currentProduct['img']],
            ]);

            $isAddedToCartMessage = $this::confirmation(true, $currentProductName);
        } else {
            $isAddedToCartMessage = $this::confirmation(false, $currentProductName);
        }


        $totalQuantity = $cart::session($sessionId)->getTotalQuantity();
        return compact('cartItem', 'totalQuantity', 'isAddedToCartMessage');
    }


    public function update(Request $request, \Cart $cart): array
    {
        $sign = $request->get('sign');
        $id = $request->get('id');
        $itemQuantity = $this::getCurrentQuantity($sign, $cart, $id, $request);
        $totalQuantity = $cart::session(Session::getId())->getTotalQuantity();
        $priceSum = $this::getProductFromSession($request)->getPriceSum();
        $sum = $cart::getTotal('price');
        return compact('sign', 'itemQuantity', 'totalQuantity', 'id', 'priceSum', 'sum');
    }


    public function remove(Request $request, \Cart $cart): array
    {
        $sessionId = Session::getId();
        $cart::session($sessionId)->remove($request['id']);
        $totalQuantity = $cart::session($sessionId)->getTotalQuantity();

        return compact('totalQuantity');
    }


    private static function confirmation($isAdded, $currentProductName): array
    {
        if ($isAdded) {
            return ['isAddedToCartMessage' => "В корзину добавлен товар: $currentProductName"];
        } else {
            return ['isAddedToCartMessage' => 'Этот товар уже находится в корзине'];
        }
    }


    private static function getProductFromSession($request)
    {
        $sessionId = Session::getId();
        return \Cart::session($sessionId)->getContent()->where('id', $request['id'])->first();
    }


    private static function getCurrentQuantity($sign, $cart, $id, $request)
    {
        if (self::getProductFromSession($request)) {
            if ($sign == '–') {
                $cart::session(Session::getId())->update($id, ['quantity' => -1,]);
                return self::getProductFromSession($request)->quantity;
            }
                $cart::session(Session::getId())->update($id, ['quantity' => 1,]);
                return self::getProductFromSession($request)->quantity;
        }
    }
}
