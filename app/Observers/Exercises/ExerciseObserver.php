<?php

namespace App\Observers\Exercises;

use App\Models\Courses\Exercises\Exercise;

class ExerciseObserver
{
    public function deleted(Exercise $exercise)
    {
        $exercise->template()->delete();
        $exercise->speechBubbles()->delete();
    }
}
