<?php

namespace App\Http\Controllers;
use App\Models\Product;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CartController extends Controller

{
    public function index(Product $product){

        $cart = \Cart::session(\Illuminate\Support\Facades\Session::getId())->getContent();
//        dd($cart);
        $sum = \Cart::getTotal('price');

        return view('cart.index', compact('cart', 'sum'));

    }

    public function addToCart(Request $request, Product $product)
    {

        $currentProduct = $product->query()->where('id', $request['id'])->first();
        $sessionId = Session::getId();


//       if (!isset($_COOKIE['cart_id'])) setcookie('cart_id', uniqid());
//        $cart_id = $_COOKIE['cart_id'];
        \Cart::session($sessionId)->add([
            'id' => $currentProduct['id'],
            'name' => $currentProduct['name'],
            'price' => $currentProduct['price'],
            'quantity' => $request->qty ?? 1,
            'attributes' => ['image' => $currentProduct['img']],
        ]);

//        $cart = \Cart::getContent();
//        dd($cart);
//        return redirect()->back;
        return redirect()->route('products_base.index');
////
    }

//        public function removeFromCart(){
//            $sessionId = Session::getId();
//            \Cart::session($sessionId)->remove();
//
//        }

    public function remove(Request $request)
    {
        $sessionId = Session::getId();
        \Cart::session($sessionId)->remove($request->id);
//        \Cart::remove($request->id);
//        session()->flash('success', 'Item Cart Remove Successfully !');

        return redirect()->route('cart.index');
    }







//        return response()->json([\Cart::getContent()]);
//        return response()->json(['id'=>$request->id]);




    public function confirmation(Product $product){
        return $product;

    }
}
