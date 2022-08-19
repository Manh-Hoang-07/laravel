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

Route::get('/login', [
    'as' => 'login',
    'uses' => 'App\Http\Controllers\Login\LoginController@login'
]);

Route::post('/login-handling', [
    'as' => 'login.login_handling',
    'uses' => 'App\Http\Controllers\Login\LoginController@login_handling'
]);

Route::prefix('admin')->group(function () {
    Route::prefix('categories')->namespace('App\Http\Controllers\Admin')->group(function () {
        //Giao diện danh sách danh mục
        Route::get('/index', [
            'as' => 'categories.index',
            'uses' => 'CategoryController@index'
        ]);
        //Giao diện thêm mới danh mục
        Route::get('/add', [
            'as' => 'categories.add',
            'uses' => 'CategoryController@add'
        ]);

        //Submit thêm mới danh mục
        Route::post('/create', [
            'as' => 'categories.create',
            'uses' => 'CategoryController@create'
        ]);

        //Giao diện sửa danh mục
        Route::get('/edit/{id}', [
            'as' => 'categories.edit',
            'uses' => 'CategoryController@edit'
        ]);

        //Submit sửa danh mục
        Route::post('/update/{id}', [
            'as' => 'categories.update',
            'uses' => 'CategoryController@update'
        ]);

        //Xóa danh mục
        Route::get('/delete/{id}', [
            'as' => 'categories.delete',
            'uses' => 'CategoryController@delete'
        ]);
    });

    Route::prefix('menus')->namespace('App\Http\Controllers\Admin')->group(function () {
        //Giao diện danh sách menu
        Route::get('/index', [
            'as' => 'menus.index',
            'uses' => 'MenuController@index'
        ]);

        //Giao diện thêm mới menu
        Route::get('/add', [
            'as' => 'menus.add',
            'uses' => 'MenuController@add'
        ]);

        //Submit thêm mới menu
        Route::post('/create', [
            'as' => 'menus.create',
            'uses' => 'MenuController@create'
        ]);

        //Giao diện sửa menu
        Route::get('/edit/{id}', [
            'as' => 'menus.edit',
            'uses' => 'MenuController@edit'
        ]);

        //Submit sửa menu
        Route::post('/update/{id}', [
            'as' => 'menus.update',
            'uses' => 'MenuController@update'
        ]);

        //Xóa menu
        Route::get('/delete/{id}', [
            'as' => 'menus.delete',
            'uses' => 'MenuController@delete'
        ]);
    });
});
