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

    /**
     * @param array $filters
     * @return EndLessonPage|null
     */
    public function findByOne(array $filters): ?EndLessonPage
    {
        return EndLessonPage::where($filters)->first();
    }
}
