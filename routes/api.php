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

Route::get('tickets', 'ApiTicketsController@index');
Route::delete('tickets/{tid}', 'ApiTicketsController@destroy');
Route::post('tickets', 'ApiTicketsController@store');
