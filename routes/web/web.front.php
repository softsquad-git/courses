<?php

use Illuminate\Support\Facades\Route;

Route::group(['prefix' => '/', 'namespace' => 'Front'], function () {
   Route::get('', 'HomeController')
       ->name('home.index');

   Route::group(['prefix' => 'kurs', 'namespace' => 'Courses'], function () {
      Route::group(['prefix' => 'lekcje'], function () {
          Route::get('', 'LessonController@index')
              ->name('front.lessons.index');
      });
   });
});
