<?php

use App\Http\Controllers\GetInfoController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SkateFromDbController;
use App\Http\Controllers\RegisteredUserController;
use App\Http\Controllers\SkateFromServerController;
use App\Http\Controllers\MailSendController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\SkateAllUpdateController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect('skates');
});


Route::get('/get_info/{name}/{price}/{info}', [GetInfoController::class, 'index'])->name('get_info.index');
Route::post('/get_info/store', [GetInfoController::class, 'store'])->name('get_info.store');


Route::get('/skates', [SkateFromDbController::class, 'index'])->name('skates_base.index');
Route::get('/skates/cat', [CategoryController::class, 'index'])->name('skates_base.cat');

Route::get('/skates/{id}', [SkateFromDbController::class, 'show'])->name('skates_base.show');
Route::get('/search', [SearchController::class, 'search'])->name('search.index');

Route::middleware(['auth'])->group(function () {
    Route::get('/skates-from-server', [SkateFromServerController::class, 'index'])->name('skates_server.index');
    Route::get('/skates-from-form/new_skate', [SkateFromDbController::class, 'create'])->name('skates_form.create');
    Route::get('/skates-from-form/store', [SkateFromDbController::class, 'store'])->name('skates_form.store');
    Route::get('/update_all', [SkateAllUpdateController::class, 'updateAll'])->name('skates_base.update_all');
    Route::get('/skates/{id}/edit', [SkateFromDbController::class, 'edit'])->name('skates_base.edit');
    Route::put('/skates/{id}', [SkateFromDbController::class, 'update'])->name('skates_base.update');
    Route::delete('/skates/{id}', [SkateFromDbController::class, 'destroy'])->name('skates_base.destroy');
    Route::get('/registered-users', [RegisteredUserController::class, 'index'])->name('registered_users.index');
    Route::get('/registered-users/create-registered-user', [RegisteredUserController::class, 'create'])->name('registered_user.create');
    Route::get('/registered-users/store', [RegisteredUserController::class, 'store'])->name('registered_user.store');
    Route::get('/registered-users/{id}/edit', [RegisteredUserController::class, 'edit'])->name('registered_user.edit');
    Route::put('/registered-users/{id}', [RegisteredUserController::class, 'update'])->name('registered_user.update');
    Route::delete('/registered-users/{id}', [RegisteredUserController::class, 'destroy'])->name('registered_user.destroy');
    Route::post('/message-send', [MailSendController::class, 'MailSend'])->name('message_send.index');
});

Route::fallback(function () {
    return 'Нет такой страницы';
});

Auth::routes(['register' => false, 'reset' => false]);


