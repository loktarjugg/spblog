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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index');

Route::get('admin/{subs?}', ['middleware' => ['auth:web', 'admin'], function () {
    return view('app');
}])->where(['subs' => '.*']);

Route::post('upload','HomeController@upload');