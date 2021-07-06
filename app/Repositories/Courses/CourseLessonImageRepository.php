<?php

namespace App\Repositories\Courses;

use App\Models\Courses\Lesson;

class CourseLessonImageRepository
{
    /**
     * @return array
     */
    public function getAll(): array
    {
        $dir = Lesson::$fileDir;
        if (!is_dir($dir))
            return [];

        return array_diff(scandir($dir), ['.', '..']);
    }
}
