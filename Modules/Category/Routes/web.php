<?php

use Modules\Category\Http\Controllers\CategoryController;

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

Route::middleware('auth.admin')->prefix('admin')->as('admin.')->group(function () {
    Route::prefix('category')->as('category.')->group(function () {
        Route::delete('/{id}/delete', [CategoryController::class, 'delete'])->name('delete');
        Route::get('/deleted', [CategoryController::class, 'deleted'])->name('deleted');
        Route::post('/{id}/restore', [CategoryController::class, 'restore'])->name('restore');
    });
    Route::resource('category', CategoryController::class);
});
