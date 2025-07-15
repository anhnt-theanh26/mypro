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

use Modules\Image\Http\Controllers\ImageController;
use UniSharp\LaravelFilemanager\Lfm;

Route::prefix('admin')->as('admin.')->group(function () {
    Route::prefix('image')->as('image.')->group(function () {
        Route::get('/', action: [ImageController::class, 'index'])->name('index');
    });
    Route::group(['prefix' => 'laravel-filemanager', 'middleware' => ['web']], function () {
        Lfm::routes();
    });
});
Route::group(['prefix' => 'laravel-filemanager', 'middleware' => ['web']], function () {
    Lfm::routes();
});

Route::get('login', [ImageController::class, 'showLoginForm'])->name('login');
Route::post('login', [ImageController::class, 'login']);