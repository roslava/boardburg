<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;

class CatalogController extends Controller
{
    public function index(Category $category, Product $product)
    {
        $cat = $category::all();
        $prod = $product::all();
       return compact('cat', 'prod');
    }

    public function show($cat, Category $category, Product $product)
    {
        $currentCategoryId = $category->query()->where('category_name_en', $cat)->first();
        $products = $product->query()->where('category_id', '=', $currentCategoryId->category_id)->get();
        return compact('products');
    }
}
