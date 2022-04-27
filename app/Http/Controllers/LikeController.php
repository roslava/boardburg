<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Support\Arr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class LikeController extends Controller
{



public function index(Session $session, Product $product){
    $products = $product::all()->toArray();
    $likes = $session::get('likesQuantity');
$likedProducts=[];
    foreach ($products as $product){

        foreach ($likes as $like){
            if ($like == $product['id']){
                $likedProducts[] = (object) $product;
            }
        }
    }

    $quantity = count($likedProducts);
    $productsFromBase = collect($likedProducts)->paginate(8);

    if ($quantity>0){
        return view('home', compact('productsFromBase', 'quantity'));
    }
    return redirect()->back();

}


 public function activeIcons(Session $session){
      if (empty($session::get('likesQuantity'))) {
         $likes = 1;
         return compact('likes');
     }
     $likes = $session::get('likesQuantity');
     return compact('likes' );
}

public function quantity(Session $session): array
{
    $likes = $session::get('likesQuantity');
    $likesQuantity = count($likes);
    return compact('likesQuantity' );
}

    public function add(Request $request){
        $id = $request->get('id');
        $likes = Session::get('likesQuantity');
        $isLike = $request->get('isLike');
        $likes[] = $id;
        Session::put('likesQuantity', $likes);

        return compact('id', 'isLike', 'likes');
    }

    public function remove(Request $request){
        $id = $request->get('id');
        $isLike = $request->get('isLike');

        $likes = Session::get('likesQuantity');

        foreach($likes as $key => $item){
            if ($item == $id){
                unset($likes[$key]);
            }
        }
        Session::put('likesQuantity', $likes);

        $likes = Session::get('likesQuantity');
        return compact('id', 'isLike', 'likes');
    }
}
