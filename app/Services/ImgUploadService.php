<?php

namespace App\Services;

use App\Models\Product;
use App\Models\TemporaryFile;
use Illuminate\Support\Facades\Config;

class ImgUploadService
{
    public function tmpFileAddToMediaLibrary($request, $product)
    {
       $temporaryFile = TemporaryFile::where('folder', $request['cover'])->first();


        $baseFilename = cut_string_using_last('/', $product['img'], 'right', false);

        if ($temporaryFile AND $temporaryFile != $baseFilename) {
            $folder = Config::get('constants.TMP_FOLDER') . $request->cover;
            $slug = Product::getSlug($request['category_id']);
            $singular_slug = substr($slug, 0, -1);
            $unic = now()->timestamp;
            $media = $product->addMedia(storage_path($folder . '/' . $temporaryFile->filename))
                ->usingFileName($singular_slug . '_' . $unic . '.jpg')
                ->toMediaCollection('cover');
            $product->img = extensionRemover($media->file_name) . '/' . $media->file_name;
            $product->save();
            rmdir(storage_path($folder)); //tmp
            $temporaryFile->delete(); //tmp
          }
    }
}
