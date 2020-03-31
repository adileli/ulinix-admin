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
    Route::get('/menus', 'AdminMenuController@index')->name('adminMenu');
});
