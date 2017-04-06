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


Auth::routes();
Route::get('login/facebook', 'Auth\LoginController@redirectToFacebook');
Route::get('login/twitter', 'Auth\LoginController@redirectToTwitter');
Route::get('login/google', 'Auth\LoginController@redirectToGoogle');
Route::get('login/{provider}/callback', 'Auth\LoginController@handleProviderCallback');
Route::get('/home', 'HomeController@index');
Route::get('/', 'HomeController@index');

/*Administrator only routes */
Route::group(['middleware' => 'admin', 'prefix' => 'admin'], function () {
    Route::group(['namespace' => 'admin'], function () {
        Route::get('/', 'AdminController@index');
        Route::get('/dashboard', 'AdminController@index');
        Route::get('/manage-sources', 'AdminController@AddDatasourceView');
        Route::post('/manage-sources', 'AdminController@AddDatasource');
        Route::get('/manage-feeds', 'AdminController@ManageFeedsView');
        Route::post('/manage-feeds', 'AdminController@ManageFeeds');

    });
});
Route::group(['middleware' => 'auth', 'prefix' => 'user'], function () {
    Route::group(['namespace' => 'user'], function () {
        Route::get('/', 'UserController@index');
        Route::get('/dashboard', 'UserController@index');
        Route::get('/create-subscription', 'UserController@ViewCreateSubscription');
        Route::post('/create-subscription', 'UserController@CreateSubscription');
        Route::get('/manage-subscriptions', 'UserController@ViewManageSubscriptions');
        Route::post('/manage-subscriptions', 'UserController@ManageSubscriptions');
        Route::get('/pricing', 'UserController@Pricing');

    });
});
