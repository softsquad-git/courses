<?php

namespace App\Providers;

use App\Models\Courses\Exercises\Exercise;
use App\Models\Courses\Lesson;
use App\Observers\Exercises\ExerciseObserver;
use App\Observers\Lessons\LessonObserver;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);
        Lesson::observe(LessonObserver::class);
        Exercise::observe(ExerciseObserver::class);
    }
}
