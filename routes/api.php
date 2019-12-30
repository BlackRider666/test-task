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
Route::middleware('auth:api')->get('/user', function (Request $request) {
        return $request->user();
    });
Route::post('/auth/logout','API\AuthController@logout')->middleware('auth:api');
Route::post('/auth/login','API\AuthController@login');
Route::post('/epizod/store','EpizodController@store');
Route::post('/sezon/store','SezonController@store');
Route::post('/serial/store','SerialController@store');
Route::get('/epizod/{id}','EpizodController@getEpizod');
Route::get('/sezon/{sezon_id}/epizods','SezonController@getSezon');
Route::get('/serial/{serial_id}','SerialController@getSerial');
Route::get('/serials','SerialController@getSerials');
