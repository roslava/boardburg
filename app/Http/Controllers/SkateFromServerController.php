<?php

namespace App\Http\Controllers;

use App\Models\Skate;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;


class SkateFromServerController extends Controller
{
    public function index()
    {
        try {
            $file = file_get_contents('http://russianborsch.com/skates.zip');
            $file_path = 'uploads/skates.zip';
            Storage::disk('public')->put('uploads/skates.zip', $file);
            $zip = new  \ZipArchive();
            if ($zip->open(Storage::path($file_path)) === TRUE) {
                $zip->extractTo(storage_path('app/public/uploads/'));
                $zip->close();
                $storageImgPath = storage_path('app/public/uploads/skates.zip');
                if ($storageImgPath) unlink($storageImgPath);
                echo 'ok';
            } else {
                echo 'failed';
            }
        } catch (Throwable $exception) {
            dd($exception->getMessage(), $exception->getFile(), $exception->getLine());
        }
        return Http::get('http://russianborsch.com/skates.json')->json();
    }

    public function store($skateFromServer)
    {
        $skates = new Skate;
        $skates::create([
            'external_id' => $skateFromServer['id'],
            'name' => $skateFromServer['name'],
            'description' => $skateFromServer['description'],
            'img' => $skateFromServer['img'],
            'price' => $skateFromServer['price'],
            'category_id' => $skateFromServer['category_id'],
            'user_id' => $skateFromServer['user_id'],
            'slug' => slugDefining($skateFromServer['category_id'])
        ]);
    }

    public function update($skateFromServer, $id)
    {
        Skate::where('external_id', $id)->update([
            'name' => $skateFromServer['name'],
            'description' => $skateFromServer['description'],
            'img' => $skateFromServer['img'],
            'price' => $skateFromServer['price'],
            'category_id' => $skateFromServer['category_id'],
            'user_id' => $skateFromServer['user_id'],
            'slug' => slugDefining($skateFromServer['category_id'])
        ]);
    }
}
