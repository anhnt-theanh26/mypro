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

use Modules\Album\Http\Controllers\AlbumController;

Route::middleware('auth.admin')->prefix('admin')->as('admin.')->group(function () {
    Route::prefix('album')->as('album.')->group(function () {
        Route::delete('/{id}/delete', [AlbumController::class, 'delete'])->name('delete');
        Route::get('/deleted', [AlbumController::class, 'deleted'])->name('deleted');
        Route::post('/{id}/restore', [AlbumController::class, 'restore'])->name('restore');
    });
    Route::resource('album', AlbumController::class);
});