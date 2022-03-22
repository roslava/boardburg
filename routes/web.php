<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ContactUsFormController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\RegisteredUserController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\ProductsSyncController;
use App\Http\Controllers\UploadController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect('products');
});

Route::post('/contact', [ContactUsFormController::class, 'ContactUsForm'])->name('contact.store');
Route::get('/reload-captcha', [ContactUsFormController::class, 'reloadCaptcha'])->name('reload-captcha');
Route::get('/products', [ProductController::class, 'index'])->name('products_base.index');//
Route::get('/products/cat', [CategoryController::class, 'index'])->name('products_base.cat');
Route::get('/products/{product}', [ProductController::class, 'show'])->name('products_base.show');
Route::get('/search', [SearchController::class, 'search'])->name('search.index');

Route::middleware(['auth'])->group(function () {
    Route::post('/upload-file', [UploadController::class, 'store'])->name('upload_file.store');
    Route::delete('/revert-tmp-file', [UploadController::class, 'revertFiles'])->name('revert_tmp_file.revert');
    Route::get('/products-from-form/new_product', [ProductController::class, 'create'])->name('products_form.create');
    Route::post('/products-from-form/store', [ProductController::class, 'store'])->name('products_form.store');
    Route::get('/update_all', [ProductsSyncController::class, 'updateAll'])->name('products_base.update_all');
    Route::get('/products/{id}/edit', [ProductController::class, 'edit'])->name('products_base.edit');
    Route::put('/products/{product}', [ProductController::class, 'update'])->name('products_base.update');
    Route::delete('/products/{product}', [ProductController::class, 'destroy'])->name('products_base.destroy');
    Route::get('/registered-users', [RegisteredUserController::class, 'index'])->name('registered_users.index');
    Route::get('/registered-users/create-registered-user', [RegisteredUserController::class, 'create'])->name('registered_user.create');
    Route::get('/registered-users/store', [RegisteredUserController::class, 'store'])->name('registered_user.store');
    Route::get('/registered-users/{id}/edit', [RegisteredUserController::class, 'edit'])->name('registered_user.edit');
    Route::put('/registered-users/{id}', [RegisteredUserController::class, 'update'])->name('registered_user.update');
    Route::delete('/registered-users/{id}', [RegisteredUserController::class, 'destroy'])->name('registered_user.destroy');

});

Route::fallback(function () {
    return 'Нет такой страницы!';
});

Auth::routes(['register' => false, 'reset' => false]);


