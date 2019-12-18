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

Route::group(['prefix' => 'auth'], function () {
    Route::post('login', 'AuthController@login');
    Route::post('logout', 'AuthController@logout');
    Route::post('refresh', 'AuthController@refresh');
    Route::post('me', 'AuthController@me');
    Route::post('payload', 'AuthController@payload');
});
Route::group(['prefix' => 'product'], function () {
    Route::post('', 'ProductController@store');
    Route::post('/{id}', 'ProductController@update');
    Route::get('/{id}', 'ProductController@show');
    Route::get('', 'ProductController@index');
    Route::delete('/{id}', 'ProductController@destroy');
});
Route::group(['prefix' => 'image'], function () {
    Route::post('', 'ImageController@store');
});
Route::group(['prefix' => 'user'], function () {
    Route::post('', 'UserController@store');
    Route::delete('/{id}', 'UserController@destroy');
    Route::get('', 'UserController@index');
});
Route::group(['prefix' => 'buy'], function () {
    Route::post('', 'UserProductsController@store');
});