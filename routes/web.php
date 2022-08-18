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
    Route::get('/add', [
        'as' => 'categories.add',
        'uses' => 'App\Http\Controllers\CategoryController@add'
    ]);

    //Submit thêm mới danh mục
    Route::post('/create', [
        'as' => 'categories.create',
        'uses' => 'App\Http\Controllers\CategoryController@create'
    ]);

    //Giao diện sửa danh mục
    Route::get('/edit/{id}', [
        'as' => 'categories.edit',
        'uses' => 'App\Http\Controllers\CategoryController@edit'
    ]);

    //Submit sửa danh mục
    Route::post('/update/{id}', [
        'as' => 'categories.update',
        'uses' => 'App\Http\Controllers\CategoryController@update'
    ]);

    //Xóa danh mục
    Route::get('/delete/{id}', [
        'as' => 'categories.delete',
        'uses' => 'App\Http\Controllers\CategoryController@delete'
    ]);
});

Route::prefix('menus')->group(function () {
    //Giao diện danh sách menu
    Route::get('/index', [
        'as' => 'menus.index',
        'uses' => 'App\Http\Controllers\MenuController@index'
    ]);

    //Giao diện thêm mới menu
    Route::get('/add', [
        'as' => 'menus.add',
        'uses' => 'App\Http\Controllers\MenuController@add'
    ]);

    //Submit thêm mới menu
    Route::post('/create', [
        'as' => 'menus.create',
        'uses' => 'App\Http\Controllers\MenuController@create'
    ]);

    //Giao diện sửa menu
    Route::get('/edit', [
        'as' => 'menus.edit',
        'uses' => 'App\Http\Controllers\MenuController@edit'
    ]);

    //Submit sửa menu
    Route::post('/update', [
        'as' => 'menus.update',
        'uses' => 'App\Http\Controllers\MenuController@update'
    ]);

    //Xóa menu
    Route::get('/delete/{id}', [
        'as' => 'menus.delete',
        'uses' => 'App\Http\Controllers\MenuController@delete'
    ]);
});
