<?php

namespace App\Repositories\Courses;

use App\Models\Users\UserLessonExerciseProgress;
use App\Repositories\Repository;

class CourseLessonProgressRepository extends Repository
{
    public function __construct(UserLessonExerciseProgress $userLessonExerciseProgress)
    {
        $this->model = $userLessonExerciseProgress;
    }

    /**
     * @param int $userId
     * @param int $lessonId
     * @return int
     */
    public function maxExerciseId(
        int $userId,
        int $lessonId
    ): int
    {
        $item = $this->model->where([
            'user_id' => $userId,
            'lesson_id' => $lessonId
        ])->max('exercise_id');

        if (!$item) {
            return 0;
        }

        return $item;
    }
}
