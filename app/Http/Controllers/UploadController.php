<?php

namespace App\Http\Controllers;

use App\Helpers;
use App\Http\Requests\CoverUploadRequest;
use App\Models\TemporaryFile;
use Illuminate\Support\Facades\Config;

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
        $dirtyArray = Helpers::dirToArray($dir_);
        Helpers::unlink($dirtyArray);
    }
}
