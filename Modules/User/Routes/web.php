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

use Modules\User\Http\Controllers\UserController;

Route::prefix('admin')->as('admin.')->group(function () {
    // Route::prefix('user')->as('user.')->group(function () {
        //     Route::delete('/{id}/delete', [UserController::class, 'delete'])->name('delete');
        //     Route::get('/deleted', [UserController::class, 'deleted'])->name('deleted');
        //     Route::post('/{id}/restore', [UserController::class, 'restore'])->name('restore');
    // });
    Route::resource('user', UserController::class);
});