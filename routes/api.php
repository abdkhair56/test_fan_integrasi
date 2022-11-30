<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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
Route::post('/register', 'RegisterController@register')->name('register');
Route::post('/login', 'LoginController@login')->name('login');
// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });
Route::group(['middleware' => ['auth:api']], function () {
    Route::get('/user', function(Request $request){
        return $request->user();
    });
    Route::post('/in', 'EpresenceController@in')->name('in');
    Route::post('/out', 'EpresenceController@out')->name('out');
    Route::post('/checkin/{id}', 'EpresenceController@checkin')->name('checkin');
    Route::get('/user-data/{id}', 'EpresenceController@userData')->name('user-data');
});
