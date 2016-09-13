<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index');

// User Management
Route::get('/users', 'UserManagementController@index')->name('users.index');
Route::get('/users/destroy/{id}', 'UserManagementController@destroy')->name('users.destroy');
Route::get('/users/token', 'userManagementController@generateToken')->name('users.token');

// Ticket management
Route::get('/tickets', 'ApiTicketsController@Index')->name('tickets.index');
