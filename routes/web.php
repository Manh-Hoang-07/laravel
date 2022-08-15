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
    return view('welcome');
});

Route::get('/home', function () {
    return view('home');
});

Route::prefix('categories')->group(function () {
    //Giao diện danh sách danh mục
    Route::get('/index', [
        'as' => 'categories.index',
        'uses' => 'App\Http\Controllers\CategoryController@index'
    ]);
    //Giao diện thêm mới danh mục
    Route::get('/create', [
        'as' => 'categories.create',
        'uses' => 'App\Http\Controllers\CategoryController@create'
    ]);

    Route::get('/selectList', [
        'as' => 'categories.selectList',
        'uses' => 'App\Http\Controllers\CategoryController@selectList'
    ]);
});
