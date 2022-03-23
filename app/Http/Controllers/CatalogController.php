<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class CatalogController extends Controller
{
    public function index(Product $product){
//        dd($product::all());
        $pr = $product::all();
        return $pr;


    }

    public function show(Product $product){

    }

}
