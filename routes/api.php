<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});

Route::group([
    'namespace' => 'Api',
], function () {
    Route::resource('/articles', 'ArticleController');
    Route::get('/articles/{slug}/replies','ArticleController@replies');
    Route::resource('/tags', 'TagController');
    Route::get('/tags-groups', 'TagController@groupList');
    Route::resource('/shares', 'ShareController');
    Route::resource('/users', 'UserController');

    Route::post('/upload', 'UploadController@upload');
});


