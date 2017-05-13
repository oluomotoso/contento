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
//Route::group(['prefix' => 'api'], function () {
    Route::get('/', 'Api/PublicController@ApiLive');
    Route::group(['middleware' => 'auth.basic'], function () {
        Route::group(['namespace' => 'Api'], function () {
            Route::get('/me/subscriptions', 'UserController@UserSubscriptions');
            Route::post('/me/update-subscription-url', 'UserController@UserUpdateSubscription');
            Route::post('/me/subscription-posts', 'UserController@UserSubscriptionFeeds');
            Route::get('/me/content/{id}', 'UserController@GetContent');
            Route::post('/me/notify-publish', 'UserController@InformPublish');
            Route::post('/me/get-sources', 'UserController@GetSubsriptionFeeds');
            Route::post('/me/sources-post', 'UserController@GetFeedsbySource');
            Route::get('/me/query-jobs', 'UserController@GetContentoJobs');


        });
    });
});