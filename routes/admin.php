<?php
use Illuminate\Support\Facades\Route;

// 后台登陆、登出路由
// 控制器 App\Http\Controllers\Admin\Login
Route::get('login', 'LoginController@showLoginForm')->name('login');
Route::post('login', 'LoginController@login');
Route::post('logout', 'LoginController@logout')->name('logout');

Route::middleware('auth:admin')->group(function () {
    Route::get('/get-system-init', 'IndexController@getSystemInit')->name('getSystemInit');
    Route::post('/change/locale/{locale}', 'IndexController@changeLocale')->name('changeLocale');

    Route::get('/', 'IndexController@admin')->name('admin');
    Route::get('/index', 'IndexController@index')->name('index');

    Route::group(['prefix' => '/admins', 'as' => 'admins.'], function () {
        Route::get('', 'AdminsController@index')->name('index');
        Route::get('/create', 'AdminsController@create')->name('create');
        Route::post('/store', 'AdminsController@store')->name('store');
        Route::get('/edit/{id}', 'AdminsController@edit')->name('edit');
        Route::post('/update/{id}', 'AdminsController@update')->name('update');
        Route::post('/delete/{id}', 'AdminsController@destroy')->name('delete');
    });

    Route::group(['prefix' => '/menus', 'as' => 'menu.'], function () {
        Route::get('', 'AdminMenuController@index')->name('index');
        Route::get('/create', 'AdminMenuController@create')->name('create');
        Route::post('/store', 'AdminMenuController@store')->name('store');
        Route::get('/edit/{id}', 'AdminMenuController@edit')->name('edit');
        Route::post('/update/{id}', 'AdminMenuController@update')->name('update');
        Route::post('/delete/{id}', 'AdminMenuController@destroy')->name('delete');
    });

    Route::get('/setting', 'ConfigController@index')->name('setting');
    Route::post('/setting', 'ConfigController@store')->name('setting');
    Route::post('/upload/logo', 'ConfigController@uploadLogo')->name('uploadLogo');
});
