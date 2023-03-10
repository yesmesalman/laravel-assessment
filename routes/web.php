<?php

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

Route::get('/', function () {
    return redirect('/films');
});

Auth::routes();
Route::get('/logout', [App\Http\Controllers\Auth\LogoutController::class, 'perform'])->name('logout.perform');


// Film Resource
Route::resource('/films', App\Http\Controllers\Resource\FilmController::class);

// Comment Resource
Route::resource('/comments', App\Http\Controllers\Resource\CommentController::class);
