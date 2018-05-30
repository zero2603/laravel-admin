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

Route::get('/home', 'HomeController@index')->name('home');
 
Route::get('/user/verify/{token}', 'Auth\RegisterController@verifyUser');

// route for partner page
Route::group(['prefix' => LaravelLocalization::setLocale(),'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'checkUserRole']], function() {

	Route::get('/dashboard', 'DashboardController@index');

	Route::post('/dashboard', 'DashboardController@index');

	Route::get('/product', 'ProductController@index');

	Route::get('/product/create', 'ProductController@create');

	Route::post('/product', 'ProductController@store');

	Route::get('/product/{id}/edit', 'ProductController@edit');

	Route::patch('/product/images/{id}', 'ProductController@update');

	Route::delete('/product/{id}', 'ProductController@destroy');

	Route::resource('/product/images', 'ProductImageController');

	Route::resource('order', 'OrderController');

	Route::get('/chart', 'ChartController@getData');

	Route::post('/chart', 'ChartController@getData');

	Route::get('/profile/{id}', 'UserController@getProfile');

	Route::patch('/profile/{id}', 'UserController@updateProfile');

	Route::get('/check-order', 'OrderController@checkOrder');

	Route::post('/check-order', 'OrderController@checkOrder');

	Route::resource('/withdraw', 'PartnerWithdrawController');

	Route::get('/balance-detail', 'PartnerWithdrawController@balanceDetail');

	Route::post('/balance-detail', 'PartnerWithdrawController@makeWithdraw');

	Route::post('/result', 'SearchController@search');

});

// route for admin page
Route::group(['prefix' => LaravelLocalization::setLocale(),'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'adminRole']], function() { 
	
	Route::get('/admin/dashboard', 'DashboardController@adminDashboardAllTime');

	Route::get('/admin/dashboard/month', 'DashboardController@adminDashboardInMonth');

	Route::post('/admin/dashboard/month', 'DashboardController@adminDashboardInMonth');

	Route::resource('/admin/users', 'UserController');

	Route::get('/admin/orders', 'OrderController@adminIndex');

	Route::get('admin/orders/{id}', 'OrderController@showInAdmin');

	Route::resource('/admin/transactions', 'PartnerTransactionController');

	Route::resource('/admin/annoucements', 'AnnoucementController');

	Route::post('/admin/result', 'SearchController@adminSearch');
});