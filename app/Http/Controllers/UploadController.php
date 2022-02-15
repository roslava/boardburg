<?php

namespace App\Http\Controllers;

use App\Models\TemporaryFile;
use Illuminate\Http\Request;

class UploadController extends Controller
{
    public function store(Request $request){
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
}
