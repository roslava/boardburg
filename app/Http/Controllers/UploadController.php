<?php

namespace App\Http\Controllers;

use App\Http\Requests\CoverUploadRequest;
use App\Models\TemporaryFile;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Storage;

class UploadController extends Controller
{
    /**
     * @param CoverUploadRequest $request
     * @return string
     */
    public function store(CoverUploadRequest $request): string
    {
        if ($request->hasFile('cover')) {
            $file = $request->file('cover');
            $filename = $file->getClientOriginalName();
            $folder = uniqid().'-'.now()->timestamp;
            $file->storeAs('tmp/'.$folder, $filename);
            $temporaryFile = new TemporaryFile;
            $temporaryFile['folder'] = $folder;
            $temporaryFile['filename'] = $filename;
            $temporaryFile->save();
            return $folder;
        }
        return '';
    }

    /**
     * @return void
     */
    public function revertFiles(){
        $dir_ = storage_path(Config::get('constants.TMP_FOLDER'));

        function dirToArray($dir): array
        {
            $result = array();
            $cdir = scandir($dir);
            foreach ($cdir as $value)
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
                    unlink(Config::get('constants.TMP_FOLDER').$key.'/'.$item[0]);
                    Storage::disk('public')->deleteDirectory('/tmp/'.$key);
                }
            }
        }
        unlink($dirtyArray);
    }
}
