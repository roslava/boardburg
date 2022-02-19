<?php

namespace App\Http\Controllers;

use App\Http\Requests\CoverUploadRequest;
use App\Models\TemporaryFile;
use Illuminate\Support\Facades\Storage;


class UploadController extends Controller
{
    public function store(CoverUploadRequest $request){
        if ($request->hasFile('cover')) {
            $file = $request->file('cover');
            $filename = $file->getClientOriginalName();
            $folder = uniqid().'-'.now()->timestamp;
            $file->storeAs('tmp/'.$folder, $filename);
            TemporaryFile::create([
                'folder' => $folder,
                'filename' => $filename,
            ]);
            return $folder;
        }
        return '';
    }

    public function revertFiles(){
        $dir_ = storage_path("app/public/tmp");

        function dirToArray($dir) {
            $result = array();
            $cdir = scandir($dir);
            foreach ($cdir as $key => $value)
            {
                if (!in_array($value,array(".","..")))
                {
                    if (is_dir($dir . DIRECTORY_SEPARATOR . $value))
                    {
                        $result[$value] = dirToArray($dir . DIRECTORY_SEPARATOR . $value);
                    }
                    else
                    {
                        $result[] = $value;
                    }
                }
            }
            return $result;
        }
        $dirtyArray = dirToArray($dir_);
        function unlink($items){
            if (is_array($items) || is_object($items))
            {
                foreach ($items as $key => $item){
                    if ( is_string($item) ) continue;
                    $AllTmps = TemporaryFile::query();
                    $currenTmp = $AllTmps->where('folder','=', $key);
                    $currenTmp->delete();
                    unlink("app/public/tmp/".$key.'/'.$item[0]);
                    Storage::disk('public')->deleteDirectory('/tmp/'.$key);
                }
            }
        }
        unlink($dirtyArray);
    }
}
