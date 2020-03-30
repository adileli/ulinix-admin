<?php
use Illuminate\Support\Facades\Route;

// 后台登陆、登出路由
// 控制器 App\Http\Controllers\Admin\Login
Route::get('login', 'LoginController@showLoginForm')->name('login');
Route::post('login', 'LoginController@login');
Route::post('logout', 'LoginController@logout')->name('logout');

Route::middleware('admin.auth')->group(function () {
    Route::get('/', 'IndexController@index')->name('index');
});
