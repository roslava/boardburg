<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SkateFromDbController;
use App\Http\Controllers\RegisteredUserController;
use App\Http\Controllers\SkateFromServerController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\SkateAllUpdateController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/



Route::fallback(function (){
    return 'Нет такой страницы';
});




//Route::get('/', function () {
//    return view('welcome');
//});
Route::get('/', function () {
    return view('home');
});


Route::middleware(['auth'])->group(function () {




Route::get('/skates-from-base/cat',[CategoryController::class, 'index'])->name('skates_base.cat');


Route::get('/skates-from-server', [SkateFromServerController::class, 'index'])->name('skates_server.index');
Route::get('/skates-from-form/new_skate', [SkateFromDbController::class, 'create'])->name('skates_form.create');
Route::get('/skates-from-form/store', [SkateFromDbController::class, 'store'])->name('skates_form.store');
//Route::get('/skates-from-base/update_all', [SkateFromDbController::class, 'updateAll'])->name('skates_base.update_all');
Route::get('/skates-from-base/update_all', [SkateAllUpdateController::class, 'updateAll'])->name('skates_base.update_all');

Route::get('/skates-from-base/{id}/edit',[SkateFromDbController::class,'edit'])->name('skates_base.edit');
Route::put('/skates-from-base/{id}',[SkateFromDbController::class,'update'])->name('skates_base.update');

Route::delete('/skates-from-base/{id}', [SkateFromDbController::class, 'destroy'])->name('skates_base.destroy');

Route::get('/skates-from-base', [SkateFromDbController::class, 'index'])->name('skates_base.index');
Route::get('/skates-from-base/{id}', [SkateFromDbController::class, 'show'])->name('skates_base.show');


Route::get('/registered-users',[RegisteredUserController::class,'index'])->name('registered_users.index');
Route::get('/registered-users/create-registered-user',[RegisteredUserController::class,'create'])->name('registered_user.create');
Route::get('/registered-users/store', [RegisteredUserController::class, 'store'])->name('registered_user.store');
Route::get('/registered-users/{id}/edit', [RegisteredUserController::class, 'edit'])->name('registered_user.edit');
Route::put('/registered-users/{id}', [RegisteredUserController::class, 'update'])->name('registered_user.update');
Route::delete('/registered-users/{id}', [RegisteredUserController::class, 'destroy'])->name('registered_user.destroy');

Route::get('/search', [SearchController::class, 'search'])->name('search.index');

});






//Auth::routes();
Auth::routes(['register' => false, 'reset'=>false]);



Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');



