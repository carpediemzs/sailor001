<?php

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
//主页
Route::get('/', 'StaticPagesController@home')
    ->name('home');
//帮助页
Route::get('/help', 'StaticPagesController@help')
    ->name('help');
//关于页
Route::get('/about', 'StaticPagesController@about')
    ->name('about');

//用户注册页面
//Route::get('/signup', 'UserController@create')
//    ->name('signup');

//用户资源路由
Route::resource('/users', 'UserController');

//邮件激活路由
Route::get('users/create/confirm/{token}', 'UserController@confirmEmail')
    ->name('users.confirm_email');


//用户登录页面
Route::get('/login', 'SessionsController@create')
    ->name('login');
//用户登录：创建新会话
Route::post('/login', 'SessionsController@store')
    ->name('login');
//用户登出：销毁会话
Route::delete('/logout', 'SessionsController@destroy')
    ->name('logout');


//显示重置密码的邮箱发送页面
Route::get('/password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')
    ->name('password.request');
//邮箱发送重设链接
Route::post('/password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')
    ->name('password.email');
//密码更新页面
Route::get('/password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')
    ->name('password.reset');
//执行密码更新操作
Route::post('/password/reset', 'Auth\ResetPasswordController@reset')
    ->name('password.update');


//微博创建路由
Route::resource('statuses', 'StatusesController', ['only'=>['store', 'destroy']]);


Route::get('/users/{user}/followings', 'UserController@followings')->name('users.followings');
Route::get('/users/{user}/followers', 'UserController@followers')->name('users.followers');


Route::post('/users/followers/{user}', 'FollowersController@store')->name('followers.store');
Route::delete('/users/followers/{user}', 'FollowersController@destroy')->name('followers.destroy');


