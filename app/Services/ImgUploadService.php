<?php

namespace App\Services;

use App\Helpers;
use App\Models\Product;
use App\Models\TemporaryFile;
use Illuminate\Support\Facades\Config;

class ImgUploadService
{

    /**
     * @param $request
     * @param $product
     * @return void
     */
    public static function tmpFileAddToMediaLibrary($request, $product)
    {
       $temporaryFile = TemporaryFile::where('folder', $request['cover'])->first();
        $baseFilename = Helpers::cutString('/', $product['img'], 'right', false);

        if ($temporaryFile AND $temporaryFile != $baseFilename) {
            $folder = Config::get('constants.TMP_FOLDER') . $request->cover;
            $slug = Product::getSlug($request['category_id']);
            $singular_slug = substr($slug, 0, -1);
            $unic = now()->timestamp;
            $media = $product->addMedia(storage_path($folder . '/' . $temporaryFile->filename))
                ->usingFileName($singular_slug . '_' . $unic . '.jpg')
                ->toMediaCollection('cover');
            $product->img = Helpers::removeExtension($media->file_name) . '/' . $media->file_name;
            $product->save();
            rmdir(storage_path($folder)); //tmp
            $temporaryFile->delete(); //tmp
          }
    }

    /**
     * @param $baseImgName
     * @param $conversionPostfix
     * @return void
     */
    public static function removeFileFromUploads($baseImgName, $conversionPostfix = null)
    {
        if ($conversionPostfix !== null) {
            $convertedFile = storage_path(Config::get('constants.EXTRACT_TO') . $baseImgName[0] . '/conversions/' . $baseImgName[0] . $conversionPostfix . '.' . $baseImgName[1]);
            if (file_exists($convertedFile)) unlink($convertedFile);
        }
        if ($conversionPostfix == null) {
            $convertedFile = storage_path(Config::get('constants.EXTRACT_TO') . $baseImgName[0] . '/' . $baseImgName[0] . '.' . $baseImgName[1]);
            if (file_exists($convertedFile)) unlink($convertedFile);
        }
    }

    /**
     * @param $baseImgNameWithoutExtension
     * @param $conversion
     * @return void
     */
    public static function removeFolderFromUploads($baseImgNameWithoutExtension, $conversion)
    {
        if ($conversion === true) {
            if (is_dir(storage_path(Config::get('constants.EXTRACT_TO') . $baseImgNameWithoutExtension . '/conversions'))) {
                rmdir(storage_path(Config::get('constants.EXTRACT_TO') . $baseImgNameWithoutExtension . '/conversions'));
            }
        }
        if ($conversion === false) {
            if (strlen($baseImgNameWithoutExtension) !== 0) {
                rmdir(storage_path(Config::get('constants.EXTRACT_TO') . $baseImgNameWithoutExtension));
            }
        }
    }
}
