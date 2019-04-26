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

