<?php

use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'auth', 'namespace' => 'Auth'], function () {
    Route::post('login', 'LoginController@login');
    Route::post('register', 'RegisterController@register');

    Route::group(['middleware' => 'auth:api'], function () {
        Route::get('logged-user', 'AuthController@findLoggedUser');
    });
});
