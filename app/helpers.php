<?php

function selectManagers(bool $check, $skates, $currentUser)
{
    if ($check) {
        return $skates->where('user_id', '=', $currentUser->id)->paginate(8);
    }
    return $skates->paginate(8);
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

function getOldQueryfromSession($session)
{
    $value = $session::get('oldQuery');
    return current($value);
}
