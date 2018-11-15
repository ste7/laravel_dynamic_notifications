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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('signup', 'SignUpController@signUp');

Route::post('password/create', 'Auth\ResetPasswordController@create');
Route::get('password/find/{token}', 'Auth\ResetPasswordController@find');
Route::post('password/reset', 'Auth\ResetPasswordController@reset');

Route::middleware('auth:api')->group(function(){
    Route::get('me', 'UserController@me');

    Route::get('notifiables/models', 'NotifiableController@getModels');
    Route::apiResource('notifiables', 'NotifiableController');

    Route::post('articles', 'ArticleController@store');
    Route::post('tags', 'TagController@store');
});
