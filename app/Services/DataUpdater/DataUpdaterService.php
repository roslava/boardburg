<?php

namespace App\Services\DataUpdater;

use App\Models\Product;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Config;

class DataUpdaterService
{
    public function index()
    {
        try {
            $file = file_get_contents(Config::get('constants.FILES_RESOURCE'));
            $file_path = 'uploads/products.zip';
            Storage::disk('public')->put(Config::get('constants.FILE_PUT_PATH'), $file);
            $zip = new  \ZipArchive();
            if ($zip->open(Storage::path($file_path)) === TRUE) {
                $zip->extractTo(storage_path(Config::get('constants.EXTRACT_TO')));
                $zip->close();
                $storageImgPath = storage_path(Config::get('constants.STORAGE_IMG_PATH'));
                if ($storageImgPath) unlink($storageImgPath); // echo 'ok';
            } else {
                echo 'failed';
            }
        } catch (Throwable $exception) {
            \Log::error($exception->getMessage(), $exception->getFile(), $exception->getLine());
        }
        return Http::get(Config::get('constants.TEXT_DATA_RESOURCE'))->json();
    }

    public function store($newestProduct)
    {
        $products = new Product;
        $products::create([
            'external_id' => $newestProduct['id'],
            'name' => $newestProduct['name'],
            'description' => $newestProduct['description'],
            'img' => $newestProduct['img'],
            'price' => $newestProduct['price'],
            'category_id' => $newestProduct['category_id'],
            'user_id' => $newestProduct['user_id'],
            'slug' => Product::getSlug($newestProduct['category_id'])
        ]);
    }

    public function update($newestProduct, $id)
    {
        Product::where('external_id', $id)->update([
            'name' => $newestProduct['name'],
            'description' => $newestProduct['description'],
            'img' => $newestProduct['img'],
            'price' => $newestProduct['price'],
            'category_id' => $newestProduct['category_id'],
            'user_id' => $newestProduct['user_id'],
            'slug' => Product::getSlug($newestProduct['category_id'])
        ]);
    }
}
