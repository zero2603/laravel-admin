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

Route::get('/product', 'ProductController@index');

Route::get('/product/create', 'ProductController@create');

Route::post('/product', 'ProductController@store');

Route::get('/product/{id}/edit', 'ProductController@edit');

Route::patch('/product/images/{id}', 'ProductController@update');

Route::delete('/product/{id}', 'ProductController@destroy');

Route::resource('/product/images', 'ProductImageController');

Route::resource('order', 'OrderController');

Route::get('/chart', 'ChartController@index');

Route::post('/chart', 'ChartController@index');

