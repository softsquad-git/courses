<?php

namespace App\Services\Courses;
use \App\Models\Users\UserLessonExerciseProgress as UserLessonExerciseProgressModel;

class UserLessonExerciseProgress
{
    public function save(array $data): UserLessonExerciseProgressModel
    {
        $item = UserLessonExerciseProgressModel::where($data)->first();
        if ($item) {
            $item->delete();
        }

        return UserLessonExerciseProgressModel::create($data);
    }
}

/**TODO
 * zmiana na kolejkę w celu wydajności
 */
