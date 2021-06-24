<?php

use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'admin', 'namespace' => 'Admin'], function () {
    Route::group(['prefix' => 'languages', 'namespace' => 'Languages'], function () {
        Route::get('', 'LanguageController@all');
        Route::get('find/{id}', 'LanguageController@find');
        Route::post('create', 'LanguageController@create');
        Route::put('update/{id}', 'LanguageController@update');
        Route::delete('remove/{id}', 'LanguageController@remove');
    });
    Route::group(['prefix' => 'courses', 'namespace' => 'Courses'], function () {
        Route::get('', 'CourseController@all');
        Route::get('find/{id}', 'CourseController@find');
        Route::post('create', 'CourseController@create');
        Route::post('update/{id}', 'CourseController@update');
        Route::delete('remove/{id}', 'CourseController@remove');

        Route::group(['prefix' => 'levels'], function () {
            Route::get('', 'LevelController@all');
            Route::get('find/{id}', 'LevelController@find');
            Route::post('create', 'LevelController@create');
            Route::put('update/{id}', 'LevelController@update');
            Route::delete('remove/{id}', 'LevelController@remove');
        });
    });
    Route::group(['prefix' => 'users', 'namespace' => 'Users'], function () {
        Route::get('', 'UserController@all');
        Route::get('find/{id}', 'UserController@find');
    });
    Route::group(['prefix' => 'settings', 'namespace' => 'Settings'], function () {
        Route::get('', 'SettingAppController@all');
        Route::get('find/{id}', 'SettingAppController@find');
        Route::patch('update/{id}', 'SettingController@update');
    });
});
