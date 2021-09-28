<?php

use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'users', 'namespace' => 'Users'], function () {
    Route::group(['prefix' => 'course', 'namespace' => 'Courses'], function () {
        Route::group(['prefix' => 'reruns'], function () {
            Route::get('', 'UserRerunsController@all');
            Route::post('create', 'UserRerunsController@create');
            Route::delete('remove/{id}', 'UserRerunsController@remove');
            Route::get('check/{exerciseId}', 'UserRerunsController@check');
            Route::get('first', 'UserRerunsController@firstRerun');
            Route::get('next/{currentId}', 'UserRerunsController@nextRerun');
        });
    });
    Route::group(['prefix' => 'payments', 'namespace' => 'Payments'], function () {
        Route::get('', 'PaymentController@all');
        Route::post('pay', 'PaymentController@payment');
        Route::post('finalization', 'PaymentController@finalization');
    });
    Route::group(['prefix' => 'audio'], function () {
        Route::get('', 'UserAudioController@all');
        Route::post('create', 'UserAudioController@create');
        Route::delete('remove/{id}', 'UserAudioController@remove');
    });

    Route::get('find', 'UserController@loggedUser');
    Route::post('change-password', 'SettingsController@changePassword');
    Route::patch('update-basic-data', 'SettingsController@updateBasicData');
});
