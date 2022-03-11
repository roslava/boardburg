<?php

//2 function calls
function getOldQueryFromSession($session)
{
    $value = $session::get('oldQuery');
    return current($value);
}

//2 function calls
function priceFilter($request, $productQuery)
{
    if ($request->filled('price_from')) {
        $productQuery->where('price', '>=', $request['price_from']);
    }
    if ($request->filled('price_to')) {
        $productQuery->where('price', '<=', $request['price_to']);
    }
}

//2 function calls
function cut_string_using_last($character, $string, $side, $keep_character = true)
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

//5 function calls
function extensionRemover($fileName)
{
    $file = $fileName;
    return substr($file, 0, strrpos($file, '.'));
 }

//2 function calls
function getExtension($shortImgName)
{
    $getExtension = explode('.', $shortImgName);
    return end($getExtension);
}
