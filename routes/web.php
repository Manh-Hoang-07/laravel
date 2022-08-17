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

    //Submit thêm mới danh mục
    Route::post('/store', [
        'as' => 'categories.store',
        'uses' => 'App\Http\Controllers\CategoryController@store'
    ]);

    //Sửa danh mục
    Route::get('/edit/{id}', [
        'as' => 'categories.edit',
        'uses' => 'App\Http\Controllers\CategoryController@edit'
    ]);

    //Xóa danh mục
    Route::get('/delete/{id}', [
        'as' => 'categories.delete',
        'uses' => 'App\Http\Controllers\CategoryController@delete'
    ]);

    Route::prefix('menus')->group(function () {
        Route::get('/', [
           'as' => 'menus.index',
           'uses' =>  'App\Http\Controllers\MenuController@index'
        ]);

        Route::get('/add', [
            'as' => 'menus.add',
            'uses' =>  'App\Http\Controllers\MenuController@add'
        ]);

        Route::get('/', [
            'as' => 'menus.index',
            'uses' =>  'App\Http\Controllers\MenuController@index'
        ]);
    });
});
