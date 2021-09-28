<?php

use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'course', 'namespace' => 'Front', 'middleware' => 'auth:api'], function () {
   Route::get('levels', 'Levels\LevelController');
   Route::get('change-level/{id}', 'Levels\LevelController@changeLevel');
   Route::get('default-level', 'Levels\LevelController@defaultLevel');
   Route::group(['prefix' => 'courses', 'namespace' => 'Courses'], function () {
      Route::get('stat/{courseId}', 'CourseController@getStat');
      Route::get('user-lesson-progress', 'LessonController@getUserLessonInfo');
   });
   Route::group(['prefix' => 'lessons', 'namespace' => 'Lessons'], function () {
       Route::get('', 'LessonController@all');
       Route::get('find/{id}', 'LessonController@find');
       Route::get('next-lesson/{lessonId}/{courseId}', 'LessonController@nextLesson');
       Route::get('end-lesson/{lessonId}', 'LessonController@getEndLesson');

       Route::group(['prefix' => 'flashcards'], function () {
           Route::get('first/{lessonId}', 'LessonFlashcardController@firstFlashcardByLesson');
           Route::get('next/{id}', 'LessonFlashcardController@nextFlashcard');
       });

       Route::get('audio/{courseId}', 'LessonAudioFilesController@all');
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
    Route::get('images', 'HomeImagesController');
});
Route::get('settings-app', 'Front\Settings\SettingController');

Route::group(['prefix' => 'pages', 'namespace' => 'Front\Pages'], function () {

    Route::group(['prefix' => 'static'], function () {
        Route::get('find-by-page/{name}', 'StaticPageController@findByPage');
    });
});
