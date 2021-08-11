<?php

namespace App\Observers\Lessons;

use App\Models\Courses\Lesson;

class LessonObserver
{
    /**
     * @param Lesson $lesson
     */
    public function deleted(Lesson $lesson)
    {
        $lesson->exercises()->delete();
    }
}
