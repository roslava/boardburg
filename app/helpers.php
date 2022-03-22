<?php

namespace App;

use App\Models\TemporaryFile;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Storage;

class Helpers
{
    /**
     * @param $character
     * @param $string
     * @param $side
     * @param bool $keep_character
     * @return false|string
     */
    public static function cutString($character, $string, $side, bool $keep_character = true)
    {
        $offset = ($keep_character ? 1 : 0);
        $whole_length = strlen($string);
        $right_length = (strlen(strrchr($string, $character)) - 1);
        $left_length = ($whole_length - $right_length - 1);
        switch ($side) {
            case 'left':
                $piece = substr($string, 0, ($left_length + $offset));
                break;
            case 'right':
                $start = (0 - ($right_length + $offset));
                $piece = substr($string, $start);
                break;
            default:
                $piece = false;
                break;
        }
        return ($piece);
    }

    /**
     * @param $fileName
     * @return false|string
     */
    public static function removeExtension($fileName)
    {
        $file = $fileName;
        return substr($file, 0, strrpos($file, '.'));
    }

    /**
     * @param $shortImgName
     * @return false|mixed|string
     */
    public static function getExtension($shortImgName)
    {
        $getExtension = explode('.', $shortImgName);
        return end($getExtension);
    }

    /**
     * @param $items
     * @return void
     */
    public static function unlink($items){
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

    /**
     * @param $dir
     * @return array
     */
    public static function dirToArray($dir): array
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
}
