<?php

use Illuminate\Support\Facades\Route;

Route::group(['middleware' => 'admin', 'namespace' => 'Admin', 'prefix' => 'admin'], function () {
    //AJAX Routes
    Route::get('/users/data', 'UserController@data');
    //AJAX Routes

    Route::resource('/users', 'UserController', ['except' => ['show', 'destroy']]);
    Route::get('/users/mail/{user}', 'UserController@showEmail')->name('users.mail');
    Route::post('/users/send-email/{user}', 'UserController@sendEmail')->name('users.send-email');
});