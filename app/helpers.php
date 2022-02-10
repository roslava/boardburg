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
            return 'suspension';

        case 3:
            return 'wheels';

        case 4:
            return 'bearings';
    }
}


function setImgPath($request, $image)
{
    if ($request->hasFile('image')) {
        $imgFile = $request->file('image');
        $filename = 'cover-' . time() . '.' . $imgFile->getClientOriginalExtension();
        $imgBig = $image::make($imgFile);
        $imgBig->resize(1200, null, function ($constraint) {
            $constraint->aspectRatio();
            $constraint->upsize();
        });
        $imgBig->save($imgFile);
        return $imgFile->storeAs('uploads/' . slugDefining($request['category_id']), $filename);
    }
}
