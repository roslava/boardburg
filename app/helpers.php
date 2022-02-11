<?php


function selectWhatShowToUser(bool $check, $skates, $currentUser)
{
    if ($check) {
        $queryResult = $skates->where('user_id', '=', $currentUser->id);
        return $queryResult;
    }
    return $skates;
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

function putLastPageInSession($skatesFromBase, $session)
{
    $session::put('lastPageIs', $skatesFromBase->lastPage());
}

function removeOldVariablesFromSession($session)
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

function priceFilter($request, $skateQuery)
{
    if ($request->filled('price_from')) {
        $skateQuery->where('price', '>=', $request['price_from']);
    }
    if ($request->filled('price_to')) {
        $skateQuery->where('price', '<=', $request['price_to']);
    }
}

function current_quantity($skateQuery)
{
    return $skateQuery->count();
}

function whoseRequest($auth, $skate)
{
    if ($auth::check() && $auth::user()->isAdmin()) {
        return $skate::query();
    } elseif ($auth::check() && $auth::user()['role'] === 'manager') {
        $currentUserId = $auth::user()['id'];
        return $skateQuery = $skate::query()->where('user_id', '=', $currentUserId);
    } else {
        return $skate::query();
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
        return $imgFile->storeAs('uploads/'.slugDefining($request['category_id']).'/'. substr($slug, 0, -1) . '_' . time(), $filename);
    }
}

// make directory name from img path
function cut_string_using_last($character, $string, $side, $keep_character=true) {
    $offset = ($keep_character ? 1 : 0);
    $whole_length = strlen($string);
    $right_length = (strlen(strrchr($string, $character)) - 1);
    $left_length = ($whole_length - $right_length - 1);
    switch($side) {
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
    return($piece);
}
