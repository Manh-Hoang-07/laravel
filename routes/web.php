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

Route::prefix('admin')->namespace('App\Http\Controllers\Admin')->group(function () {

    //Route danh mục sản phẩm
    Route::prefix('categories')->group(function () {
        //Giao diện danh sách danh mục
        Route::get('/index', [
            'as' => 'admin.categories.index',
            'uses' => 'CategoryController@index'
        ]);
        //Giao diện thêm mới danh mục
        Route::get('/add', [
            'as' => 'admin.categories.add',
            'uses' => 'CategoryController@add'
        ]);

        //Submit thêm mới danh mục
        Route::post('/create', [
            'as' => 'admin.categories.create',
            'uses' => 'CategoryController@create'
        ]);

        //Giao diện sửa danh mục
        Route::get('/edit/{id}', [
            'as' => 'admin.categories.edit',
            'uses' => 'CategoryController@edit'
        ]);

        //Submit sửa danh mục
        Route::post('/update/{id}', [
            'as' => 'admin.categories.update',
            'uses' => 'CategoryController@update'
        ]);

        //Xóa danh mục
        Route::get('/delete/{id}', [
            'as' => 'admin.categories.delete',
            'uses' => 'CategoryController@delete'
        ]);
    });

    //Route menu
    Route::prefix('menus')->group(function () {
        //Giao diện danh sách menu
        Route::get('/index', [
            'as' => 'admin.menus.index',
            'uses' => 'MenuController@index'
        ]);

        //Giao diện thêm mới menu
        Route::get('/add', [
            'as' => 'admin.menus.add',
            'uses' => 'MenuController@add'
        ]);

        //Submit thêm mới menu
        Route::post('/create', [
            'as' => 'admin.menus.create',
            'uses' => 'MenuController@create'
        ]);

        //Giao diện sửa menu
        Route::get('/edit/{id}', [
            'as' => 'admin.menus.edit',
            'uses' => 'MenuController@edit'
        ]);

        //Submit sửa menu
        Route::post('/update/{id}', [
            'as' => 'admin.menus.update',
            'uses' => 'MenuController@update'
        ]);

        //Xóa menu
        Route::get('/delete/{id}', [
            'as' => 'admin.menus.delete',
            'uses' => 'MenuController@delete'
        ]);
    });

    //Route sản phẩm
    Route::prefix('products')->group(function () {
        //Route danh sách sản phẩm
        Route::get('/index', [
            'as' => 'admin.products.index',
            'uses' => 'ProductController@index'
        ]);

        //Route giao diện sản phẩm
        Route::get('/add', [
            'as' => 'admin.products.add',
            'uses' => 'ProductController@add'
        ]);

        //Route submit thêm mới sản phẩm
        Route::post('/create', [
            'as' => 'admin.products.create',
            'uses' => 'ProductController@create'
        ]);

        //Route giao diện chỉnh sứa sản phẩm
        Route::get('/edit', [
            'as' => 'admin.products.edit',
            'uses' => 'ProductController@edit'
        ]);

        //Route submit chỉnh sửa sản phẩm
        Route::post('/update', [
            'as' => 'admin.products.update',
            'uses' => 'ProductController@update'
        ]);

        //Route xóa sản phẩm
        Route::get('/delete', [
            'as' => 'admin.products.delete',
            'uses' => 'ProductController@delete'
        ]);
    });
});
