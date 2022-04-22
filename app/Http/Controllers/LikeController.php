<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class LikeController extends Controller
{


 public function likeActiveIcons(Session $session){
      if (empty($session::get('likesQuantity'))) {
         $likes = 1;
         return compact('likes');
     }
     $likes = $session::get('likesQuantity');
     return compact('likes' );
}

public function likesCountShow(Session $session){
    $likes = $session::get('likesQuantity');
    $likesCount = count($likes);
    return compact('likesCount' );
}

    public function addLike(Request $request){
        $id = $request->get('id');
        $likes = Session::get('likesQuantity');
        $isLike = $request->get('isLike');
        $likes[] = $id;
        Session::put('likesQuantity', $likes);

        return compact('id', 'isLike', 'likes');
    }

    public function removeLike(Request $request){
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
