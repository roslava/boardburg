<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Spatie\MediaLibraryPro\Rules\Concerns\ValidatesMedia;

class CoverUploadRequest extends FormRequest
//{
//
//    use ValidatesMedia;
//
//    public function rules()
//    {
//        return [
//            'cover' => $this
//                ->validateSingleMedia()
////                ->extension('png')
////                ->maxItemSizeInKb(1024)
//        ];
//    }
//
//}
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
//            'cover' => 'required',
        ];
    }
}
