<?php

namespace App\Http\Controllers;

use App\Models\Info;


class GetInfoController extends Controller
{
    public function index($name, $color, $price )
    {
        echo $name.' '.$color.' '.$price;
        $this->store($name, $color, $price );
    }

    public function store(Info $info){
        $infos = new $info;
        $infos::create([
            'name' => 'name',
            'color' => 'color',
            'price' =>'price'
        ]);
    }
}
