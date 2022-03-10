<?php

function selectWhatShowToUser(bool $check, $products, $currentUser)
{
    if ($check) {
        $queryResult = $products->where('user_id', '=', $currentUser->id);
        return $queryResult;
    }
    return $products;
}

function roleCheck($currentUser, $authCheck): bool
{
    if ($authCheck && $currentUser->role === 'manager') {
        return true;
    }
    return false;
}

function putQueryInSession($request, $session)
{
    $requestQuery = $request->query;
    $session::put('oldQuery', $requestQuery);
}

function getOldQueryFromSession($session)
{
    $value = $session::get('oldQuery');
    return current($value);
}

function putLastPageInSession($productsFromBase, $session)
{
    $session::put('lastPageIs', $productsFromBase->lastPage());
}

function forgetOldVariablesFromSession($session)
{
    if ($session::has('oldQuery')) {
        $session::forget('oldQuery');
    }
    if ($session::has('lastPageIs')) {
        $session::forget('lastPageIs');
    }
}

function getLastPageFromSession($session, $quantity): array
{
    if ($quantity % 8 === 1) {
        $page = $session::get('lastPageIs') + 1;
        return compact('page');
    }
    $page = $session::get('lastPageIs');
    return compact('page');
}

function priceFilter($request, $productQuery)
{
    if ($request->filled('price_from')) {
        $productQuery->where('price', '>=', $request['price_from']);
    }
    if ($request->filled('price_to')) {
        $productQuery->where('price', '<=', $request['price_to']);
    }
}

function current_quantity($productQuery)
{
    return $productQuery->count();
}

function whoseRequest($auth, $product)
{
    if ($auth::check() && $auth::user()->isAdmin()) {
        return $product::query();
    } elseif ($auth::check() && $auth::user()['role'] === 'manager') {
        $currentUserId = $auth::user()['id'];
        return $productQuery = $product::query()->where('user_id', '=', $currentUserId);
    } else {
        return $product::query();
    }
}


function slugDefining($data)
{

    switch ($data) {
        case 1:
            return 'boards';

        case 2:
            return 'suspensions';

        case 3:
            return 'wheels';

        case 4:
            return 'bearings';
    }
}


function setImgPath($request, $image, $slug)
{
    if ($request->hasFile('image')) {
        $imgFile = $request->file('image');
        $filename = substr($slug, 0, -1) . '_' . time() . '.' . $imgFile->getClientOriginalExtension();
        $imgBig = $image::make($imgFile);
        $imgBig->resize(1200, null, function ($constraint) {
            $constraint->aspectRatio();
            $constraint->upsize();
        });
        $imgBig->save($imgFile);
        return $imgFile->storeAs('uploads/' . slugDefining($request['category_id']) . '/' . substr($slug, 0, -1) . '_' . time(), $filename);
    }
}

// make directory name from img path
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

function getMime($fileName)
{
    $parts = explode('.', $fileName);
    return end($parts);
}


function extensionRemover($fileName)
{
// Initializing a variable
// with filename
    $file = $fileName;

// Using substr
    $x = substr($file, 0, strrpos($file, '.'));

// Display the filename
    return $x;
}


function removeRecordInMediaTable($model, $shortImgName)
{
    $mediaItems = $model->first()->getMedia('cover');
    $mediaItem = $mediaItems->where('file_name', '=', $shortImgName)->first();
    if ($mediaItem) {
        $mediaItem->delete();
    }

}

function tmpFileAddToMediaLibrary($request, $currentProduct, $temporaryFile)
{
    $folder = 'app/public/tmp/' . $request->cover;
    $slug = slugDefining($request['category_id']);
    $singular_slug = substr($slug, 0, -1);
    $unic = now()->timestamp;
    $media = $currentProduct->addMedia(storage_path($folder . '/' . $temporaryFile->filename))
        ->usingFileName($singular_slug . '_' . $unic . '.jpg')
        ->toMediaCollection('cover');
    $currentProduct->img = extensionRemover($media->file_name) . '/' . $media->file_name;
    $currentProduct->save();
    rmdir(storage_path($folder)); //tmp
    $temporaryFile->delete(); //tmp
}

function removeFileFromUploads($baseImgName, $conversionPostfix = null)
{
    if ($conversionPostfix !== null) {
        $convertedFile = storage_path('app/public/uploads/' . $baseImgName[0] . '/conversions/' . $baseImgName[0] . $conversionPostfix . '.' . $baseImgName[1]);
        if (file_exists($convertedFile)) unlink($convertedFile);
    }
    if ($conversionPostfix == null) {
        $convertedFile = storage_path('app/public/uploads/' . $baseImgName[0] . '/' . $baseImgName[0] . '.' . $baseImgName[1]);
        if (file_exists($convertedFile)) unlink($convertedFile);
    }
}

function removeFolderFromUploads($baseImgNameWithoutExtension, $conversion)
{
    if ($conversion === true) {
        if (is_dir(storage_path('app/public/uploads/' . $baseImgNameWithoutExtension . '/conversions'))) {
            rmdir(storage_path('app/public/uploads/' . $baseImgNameWithoutExtension . '/conversions'));
        }
    }
    if ($conversion === false) {
        if (strlen($baseImgNameWithoutExtension) !== 0) {
            rmdir(storage_path('app/public/uploads/' . $baseImgNameWithoutExtension));
        }
    }
}

function getExtension($shortImgName)
{
    $getExtension = explode('.', $shortImgName);
    return end($getExtension);
}
