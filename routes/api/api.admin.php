<?php

use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'admin', 'namespace' => 'Admin', 'middleware' => 'web'], function () {
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
            Route::post('update/{id}', 'LevelController@update');
            Route::delete('remove/{id}', 'LevelController@remove');
        });

        Route::group(['prefix' => 'lessons'], function () {
            Route::get('', 'CourseLessonController@all');
            Route::post('create', 'CourseLessonController@create');
            Route::post('update/{id}', 'CourseLessonController@update');
            Route::delete('remove/{id}', 'CourseLessonController@remove');
            Route::get('find/{id}', 'CourseLessonController@find');

            Route::group(['prefix' => 'images'], function () {
               Route::get('', 'CourseLessonImagesController@all');
               Route::post('upload', 'CourseLessonImagesController@upload');
               Route::delete('remove', 'CourseLessonImagesController@remove');
            });

            Route::group(['prefix' => 'exercises'], function () {
                Route::get('', 'CourseLessonExerciseController@all');
                Route::get('types', 'ExercisesTypeController');
                Route::post('create', 'CourseLessonExerciseController@create');
            });
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
    Route::group(['prefix' => 'newsletters', 'namespace' => 'Newsletter'], function () {
        Route::get('', 'NewsletterController@all');
    });
    Route::group(['prefix' => 'payments', 'namespace' => 'Payments'], function (){

        Route::group(['prefix' => 'subscriptions', 'namespace' => 'Subscriptions'], function () {
           Route::get('', 'SubscriptionController@all');
           Route::get('find/{id}', 'SubscriptionController@find');
           Route::post('create', 'SubscriptionController@create');
           Route::post('update/{id}', 'SubscriptionController@update');
           Route::delete('remove/{id}', 'SubscriptionController@remove');
        });

        Route::group(['prefix' => 'discount-codes'], function () {
            Route::get('', 'PromotionalCodeController@all');
            Route::post('create', 'PromotionalCodeController@create');
            Route::post('update/{id}', 'PromotionalCodeController@update');
            Route::delete('remove/{id}', 'PromotionalCodeController@remove');
            Route::get('find/{id}', 'PromotionalCodeController@find');
        });
    });
    Route::group(['prefix' => 'testimonials', 'namespace' => 'Testimonials'], function () {
        Route::get('', 'TestimonialController@all');
        Route::post('create', 'TestimonialController@create');
        Route::post('update/{id}', 'TestimonialController@update');
        Route::delete('remove/{id}', 'TestimonialController@remove');
        Route::get('find/{id}', 'TestimonialController@find');
    });
    Route::group(['prefix' => 'home', 'namespace' => 'Home'], function () {
        Route::group(['prefix' => 'information'], function () {
            Route::get('', 'HomeInformationController@index')
                ->name('admin.home.information.index');
            Route::match(['get', 'post'], 'create', 'HomeInformationController@create')
                ->name('admin.home.information.create');
            Route::match(['get', 'post'], 'update/{id}', 'HomeInformationController@update')
                ->name('admin.home.information.update');
            Route::delete('remove/{id}', 'HomeInformationController@remove')
                ->name('admin.home.information.remove');
        });
        Route::group(['prefix' => 'information_images'], function () {
            Route::get('', 'HomeInformationImagesController@index')
                ->name('admin.home.information_images.index');
            Route::match(['get', 'post'], 'create', 'HomeInformationImagesController@create')
                ->name('admin.home.information_images.create');
            Route::match(['get', 'post'], 'update/{id}', 'HomeInformationImagesController@update')
                ->name('admin.home.information_images.update');
            Route::delete('remove/{id}', 'HomeInformationImagesController@remove')
                ->name('admin.home.information_images.remove');
        });
    });
});
