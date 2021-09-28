<?php

namespace App\Repositories\Courses;

use App\Models\Lessons\EndLessonPage;

class CourseLessonEndPageRepository
{
    /**
     * @param int $id
     * @return EndLessonPage|null
     */
    public function find(int $id): ?EndLessonPage
    {
        return EndLessonPage::find($id);
    }
}
