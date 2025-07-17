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

use Modules\Song\Http\Controllers\SongController;

Route::middleware('auth.admin')->prefix('admin')->as('admin.')->group(function () {
    Route::prefix('song')->as('song.')->group(function () {
        Route::delete('/{id}/delete', [SongController::class, 'delete'])->name('delete');
        Route::get('/deleted', [SongController::class, 'deleted'])->name('deleted');
        Route::post('/{id}/restore', [SongController::class, 'restore'])->name('restore');
    });
    Route::resource('song', SongController::class);
});