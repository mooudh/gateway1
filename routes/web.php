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

Route::get('/bank/request','gatewayController@index');
Route::post('/bank/response','gatewayController@store');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::post('/home','gatewayController@gate');
