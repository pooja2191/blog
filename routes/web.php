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

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::group(['middleware' => ['auth']], function () {

    Route::get('/blogs', [App\Http\Controllers\BlogController::class, 'index'])->name('blog');
    Route::get('/create_blog', [App\Http\Controllers\BlogController::class, 'create'])->name('createblog');
    Route::post('/blog_store', [App\Http\Controllers\BlogController::class, 'store'])->name('storeblog');
    Route::get('/edit_blog/{id?}', [App\Http\Controllers\BlogController::class, 'edit'])->name('editblog');
    Route::post('/update_blog/{id?}', [App\Http\Controllers\BlogController::class, 'update'])->name('updateblog');
    Route::get('/delete_blog/{id?}', [App\Http\Controllers\BlogController::class, 'destroy'])->name('deleteblog');
    
});
