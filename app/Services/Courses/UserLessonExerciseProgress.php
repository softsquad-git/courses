<?php

namespace App\Services\Courses;
use App\Models\Users\UserLessonExerciseProgress as UserLessonExerciseProgressModel;

class UserLessonExerciseProgress
{
    /**
     * @param array $data
     * @return UserLessonExerciseProgressModel
     */
    public function save(array $data): UserLessonExerciseProgressModel
    {
        $item = UserLessonExerciseProgressModel::where($data)->first();

        $item?->delete();

        return UserLessonExerciseProgressModel::create($data);
    }
}

/**TODO
 * zmiana na kolejkę w celu wydajności
 */
