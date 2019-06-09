<?php

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

Route::post('register', 'Auth\RegisterController@register');
Route::post('login', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout');
Route::post('password/email', 'Auth\ForgotPasswordController@getResetToken');
Route::post('password/reset', 'Auth\ResetPasswordController@reset');

Route::group(['middleware' => 'auth:api'], function () {
    Route::get('products', 'ProductController@index');
    Route::get('products/{product}', 'ProductController@show');
    Route::post('products', 'ProductController@store');
    Route::put('products/{product}', 'ProductController@update');
    Route::delete('products/{product}', 'ProductController@delete');
});
