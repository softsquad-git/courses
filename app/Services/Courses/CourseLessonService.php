<?php

namespace App\Services\Courses;

use App\Models\Courses\Lesson;
use App\Services\Service;
use JetBrains\PhpStorm\Pure;

class CourseLessonService extends Service
{
    /**
     * @param Lesson $model
     */
    #[Pure] public function __construct(Lesson $model)
    {
        parent::__construct($model);
    }
}
