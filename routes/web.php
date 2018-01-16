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

Route::get('/', 'PagesController@index');

Route::group(['prefix' => '/api'], function () {
    Route::get('/info', 'ApiController@info');
    Route::get('/boxes', 'ApiController@boxes');
    Route::get('/user/{id}', 'ApiController@user');
    Route::get('/withdraws', 'ApiController@withdraws');
    Route::post('/fakeOpen', 'ApiController@fakeOpen');
    Route::post('/logout', 'AuthController@logout');
    Route::post('/buy-box', 'ApiController@openBox');
    Route::post('/authenticate', 'ApiController@authenticate');
    Route::post('/user/activate-affiliate', 'ApiController@activateAffiliate');
    Route::post('/user/affiliate', 'ApiController@affiliate');
    Route::post('/user/withdraw', 'ApiController@withdraw');
    Route::post('/payment/create', 'ApiController@createPayment');
    Route::post('/payment/paytrio', 'ApiController@paytrio');
    Route::post('/payment/freekassa', 'ApiController@freekassa');
});

Route::group(['prefix' => '/auth'], function () {
    Route::get('/{provider}', 'AuthController@login');
    Route::get('/callback/{provider}', 'AuthController@callback');
});

Route::group(['prefix' => '/admin', 'middleware' => 'Access:admin'], function() {
    Route::get('/', 'AdminController@index');
    Route::get('/settings', 'AdminController@settings');
    Route::get('/saveSettings', 'AdminController@saveSettings');
    Route::get('/lastOpen', 'AdminController@lastOpen');
    Route::get('/lastWithdraw', 'AdminController@lastWithdraw');
    Route::get('/users', 'AdminController@users');
    Route::get('/user/{id}', 'AdminController@user');
    Route::get('/saveUser', 'AdminController@saveUser');
    Route::get('/cases', 'AdminController@cases');
    Route::get('/case/{id}', 'AdminController@casee');
    Route::get('/saveCase', 'AdminController@saveCase');
    Route::get('/addCase', 'AdminController@addCase');
    Route::get('/addCasePost', 'AdminController@addCasePost');
    Route::get('/addItem', 'AdminController@addItem');
    Route::get('/addItemPost', 'AdminController@addItemPost');
    Route::get('/item/{id}', 'AdminController@item');
    Route::get('/saveItem', 'AdminController@saveItem');
    Route::get('/addUser', 'AdminController@addUser');
    Route::get('/addUserPost', 'AdminController@addUserPost');
    Route::get('/items', 'AdminController@items');
    Route::get('/acceptWithdraw/{id}', 'AdminController@acceptWithdraw');
    Route::get('/declineWithdraw/{id}', 'AdminController@declineWithdraw');
    Route::get('/lastOrders', 'AdminController@lastOrders');
});