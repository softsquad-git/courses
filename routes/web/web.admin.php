<?php

use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'administration', 'namespace' => 'Admin'], function () {
    Route::get('', 'AdminController')
        ->name('admin.index');
    Route::group(['prefix' => 'languages', 'namespace' => 'Languages'], function () {
        Route::get('', 'LanguageController@all')
            ->name('admin.languages');
        Route::match(['get', 'post'], 'create', 'LanguageController@create')
            ->name('admin.language.create');
        Route::match(['get', 'post'], 'update/{id}', 'LanguageController@update')
            ->name('admin.language.update');
        Route::delete('remove/{id}', 'LanguageController@remove')
            ->name('admin.language.remove');
    });
    Route::group(['prefix' => 'courses', 'namespace' => 'Courses'], function () {
        Route::get('', 'CourseController@all')
            ->name('admin.courses');
        Route::match(['get', 'post'],'create', 'CourseController@create')
            ->name('admin.course.create');
        Route::match(['get', 'post'],'update/{id}', 'CourseController@update')
            ->name('admin.course.update');
        Route::delete('remove/{id}', 'CourseController@remove')
            ->name('admin.course.remove');

        Route::group(['prefix' => 'levels'], function () {
            Route::get('', 'LevelController@all')
                ->name('admin.course.levels');
            Route::match(['get', 'post'],'create', 'LevelController@create')
                ->name('admin.course.level.create');
            Route::match(['get', 'post'],'update/{id}', 'LevelController@update')
                ->name('admin.course.level.update');
            Route::delete('remove/{id}', 'LevelController@remove')
                ->name('admin.course.level.remove');
        });

        Route::group(['prefix' => 'lessons'], function () {
            Route::get('', 'CourseLessonController@all')
                ->name('admin.course.lessons');
            Route::match(['get', 'post'],'create', 'CourseLessonController@create')
                ->name('admin.course.lesson.create');
            Route::match(['get', 'post'],'update/{id}', 'CourseLessonController@update')
                ->name('admin.course.lesson.update');
            Route::delete('remove/{id}', 'CourseLessonController@remove')
                ->name('admin.course.lesson.remove');

            Route::group(['prefix' => 'audio'], function () {
               Route::get('/{lessonId}', 'CourseLessonAudioFilesController@index')
                   ->name('admin.course.lessons.audio.index');
               Route::post('create/{lessonId}', 'CourseLessonAudioFilesController@create')
                   ->name('admin.course.lessons.audio.create');
               Route::delete('remove/{id}', 'CourseLessonAudioFilesController@remove')
                   ->name('admin.course.lessons.audio.remove');
            });

            Route::group(['prefix' => 'images'], function () {
                Route::get('', 'CourseLessonImagesController@all');
                Route::post('upload', 'CourseLessonImagesController@upload');
                Route::delete('remove', 'CourseLessonImagesController@remove');
            });

            Route::group(['prefix' => 'exercises'], function () {
                Route::get('/{lessonId}', 'CourseLessonExerciseController@all')
                    ->name('admin.exercises');
                Route::match(['get', 'post'], 'create/{lessonId}', 'CourseLessonExerciseController@create')
                    ->name('admin.exercise.create');
                Route::delete('remove/{id}', 'CourseLessonExerciseController@remove')
                    ->name('admin.exercise.remove');
            });

            Route::group(['prefix' => 'flashcards'], function () {
               Route::get('/{lessonId}', 'CourseLessonFlashcardsController@index')
                   ->name('admin.course.lessons.flashcards.index');
               Route::match(['get', 'post'], 'create/{lessonId}', 'CourseLessonFlashcardsController@create')
                   ->name('admin.course.lessons.flashcards.create');
               Route::match(['get', 'post'], 'update/{id}', 'CourseLessonFlashcardsController@update')
                   ->name('admin.course.lessons.flashcards.update');
               Route::delete('remove/{id}', 'CourseLessonFlashcardsController@remove')
                   ->name('admin.course.lessons.flashcards.remove');
            });
        });
    });
    Route::group(['prefix' => 'users', 'namespace' => 'Users'], function () {
        Route::get('', 'UserController@all')
            ->name('admin.users');
        Route::get('find/{id}', 'UserController@find')
            ->name('admin.user.show');
    });
    Route::group(['prefix' => 'settings', 'namespace' => 'Settings'], function () {
        Route::get('', 'SettingAppController@index')
            ->name('admin.setting.index');
        Route::match(['get', 'post'], 'application', 'SettingAppController@application')
            ->name('admin.setting.application');
        Route::match(['get', 'post'], 'account', 'SettingAppController@account')
            ->name('admin.setting.account');
        Route::patch('update-basic-data', 'SettingAppController@changeBasicData')
            ->name('admin.setting.change_basic_data');
        Route::patch('update-password', 'SettingAppController@changePassword')
            ->name('admin.setting.change_password');
    });
    Route::group(['prefix' => 'newsletters', 'namespace' => 'Newsletter'], function () {
        Route::get('', 'NewsletterController@all');
    });
    Route::group(['prefix' => 'payments', 'namespace' => 'Payments'], function (){
        Route::get('', 'PaymentController@index')
            ->name('admin.payments.index');

        Route::group(['prefix' => 'subscriptions', 'namespace' => 'Subscriptions'], function () {
            Route::get('', 'SubscriptionController@all')
                ->name('admin.subscriptions');
            Route::match(['get', 'post'],'create', 'SubscriptionController@create')
                ->name('admin.subscription.create');
            Route::match(['get', 'post'],'update/{id}', 'SubscriptionController@update')
                ->name('admin.subscription.update');
            Route::delete('remove/{id}', 'SubscriptionController@remove')
                ->name('admin.subscription.remove');
        });

        Route::group(['prefix' => 'discount-codes'], function () {
            Route::get('', 'PromotionalCodeController@all')
                ->name('admin.discount_codes');
            Route::match(['get', 'post'], 'create', 'PromotionalCodeController@create')
                ->name('admin.discount_code.create');
            Route::match(['get', 'post'], 'update/{id}', 'PromotionalCodeController@update')
                ->name('admin.discount_code.update');
            Route::delete('remove/{id}', 'PromotionalCodeController@remove')
                ->name('admin.discount_code.remove');
        });
    });
    Route::group(['prefix' => 'testimonials', 'namespace' => 'Testimonials'], function () {
        Route::get('', 'TestimonialController@all')
            ->name('admin.testimonials');
        Route::match(['get', 'post'],'create', 'TestimonialController@create')
            ->name('admin.testimonial.create');
        Route::match(['get', 'post'],'update/{id}', 'TestimonialController@update')
            ->name('admin.testimonial.update');
        Route::delete('remove/{id}', 'TestimonialController@remove')
            ->name('admin.testimonial.remove');
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
        Route::group(['prefix' => 'words'], function () {
           Route::match(['get', 'post'], '{id?}', 'HomeWordsController@index')
               ->name('admin.home.words.index');
           Route::delete('remove/{id}', 'HomeWordsController@remove')
               ->name('admin.home.words.remove');
        });
        Route::group(['prefix' => 'images'], function () {
            Route::match(['get', 'post'], '', 'HomeImagesController@index')
                ->name('admin.home.images.index');
            Route::delete('remove/{id}', 'HomeImagesController@remove')
                ->name('admin.home.images.remove');
        });
    });

    Route::group(['prefix' => 'pages', 'namespace' => 'Pages'], function () {

       Route::group(['prefix' => 'static'], function () {
          Route::get('', 'StaticPageController@index')
              ->name('admin.pages.static_pages.index');
          Route::match(['get', 'post'], 'update/{id}', 'StaticPageController@update')
              ->name('admin.pages.static_pages.update');
       });
    });
});
