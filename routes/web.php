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
Route::get('/epizod/show/{id}','EpizodController@show')->name('epizod.show');
Route::post('/epizod/store','EpizodController@store')->name('epizod.store')->middleware('auth','admin');
Route::get('/sezon/{id}/epizod/create','EpizodController@create')->name('epizod.create')->middleware('auth','admin');
Route::get('/sezon/show/{id}','SezonController@show')->name('sezon.show');
Route::post('/sezon/store','SezonController@store')->name('sezon.store')->middleware('auth','admin');
Route::get('/serial/{id}/sezon/create','SezonController@create')->name('sezon.create')->middleware('auth','admin');
Route::get('/serial/show/{id}','SerialController@show')->name('serial.show');
Route::post('/serial/store','SerialController@store')->name('serial.store')->middleware('auth','admin');
Route::get('/serial/create','SerialController@create')->name('serial.create')->middleware('auth','admin');
Route::get('/','SerialController@index')->name('serial.index');
Auth::routes();
