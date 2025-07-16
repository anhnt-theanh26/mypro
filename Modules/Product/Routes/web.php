<?php

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

use Modules\Product\Http\Controllers\ProductController;

Route::middleware('auth.admin')->prefix('admin')->as('admin.')->group(function () {
    Route::prefix('product')->as('product.')->group(function () {
        Route::delete('/{id}/delete', [ProductController::class, 'delete'])->name('delete');
        Route::get('/deleted', [ProductController::class, 'deleted'])->name('deleted');
        Route::post('/{id}/restore', [ProductController::class, 'restore'])->name('restore');
    });
    Route::resource('product', ProductController::class);
});
