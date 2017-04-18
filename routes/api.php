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
Route::group(['domain' => 'api.contento.com.ng'], function () {
    Route::get('/', 'Api/PublicController@ApiLive');
    Route::group(['middleware' => 'auth.basic'], function () {
        Route::group(['namespace' => 'Api'], function () {
            Route::get('/me/subscriptions', 'UserController@UserSubscriptions');

        });
    });
});