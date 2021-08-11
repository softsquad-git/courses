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
    Route::group(['prefix' => 'payments', 'namespace' => 'Payments'], function () {
        Route::get('', 'PaymentController@all');
        Route::post('pay', 'PaymentController@payment');
        Route::post('finalization', 'PaymentController@finalization');
    });

    Route::get('find', 'UserController@loggedUser');
    Route::post('change-password', 'SettingsController@changePassword');
    Route::patch('update-basic-data', 'SettingsController@updateBasicData');
});
