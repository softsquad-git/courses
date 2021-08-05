<?php

use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'users', 'namespace' => 'Users'], function () {
    Route::group(['prefix' => 'course', 'namespace' => 'Courses'], function () {
        Route::group(['prefix' => 'reruns'], function () {
            Route::get('', 'UserRerunsController@all');
            Route::post('create', 'UserRerunsController@create');
            Route::delete('remove/{id}', 'UserRerunsController@remove');
        });
    });

    Route::get('find', 'UserController@loggedUser');
    Route::post('change-password', 'SettingsController@changePassword');
    Route::patch('update-basic-data', 'SettingsController@updateBasicData');
});
