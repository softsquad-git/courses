<?php

use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'course', 'namespace' => 'Front', 'middleware' => 'auth:api'], function () {
   Route::get('levels', 'Levels\LevelController');
   Route::group(['prefix' => 'courses', 'namespace' => 'Courses'], function () {
      Route::get('stat/{courseId}', 'CourseController@getStat');
   });
   Route::group(['prefix' => 'lessons', 'namespace' => 'Lessons'], function () {
       Route::get('', 'LessonController@all');
       Route::get('find/{id}', 'LessonController@find');
   });
    Route::group(['prefix' => 'payments', 'namespace' => 'Payments'], function () {
        Route::get('subscriptions', 'SubscriptionController');
    });
    Route::group(['prefix' => 'exercises', 'namespace' => 'Exercises'], function () {
       Route::get('find', 'ExerciseController@find');
    });

});
Route::group(['prefix' => 'home', 'namespace' => 'Front\Home'], function () {
    Route::get('information', 'HomeInformationController');
    Route::get('information-images', 'HomeInformationImagesController');
    Route::get('testimonials', 'TestimonialsController@all');
    Route::get('words', 'HomeWordsController');
});
