<?php

namespace App\Services\Courses\Exercises\Partials;

use App\Models\Courses\Exercises\ExerciseListenAnswerQuestionAnswer;
use Illuminate\Database\Eloquent\Model;

class ExerciseQuestionAnswersService
{
    /**
     * @param array $data
     * @param Model $model
     * @return bool
     */
    public function save(array $data, Model $model): bool
    {
        $dataSave = [];

        foreach ($data as $datum) {
            $dataSave[] = [
                'question_id' => $model->id,
                'exercise_id' => $model->exercise_id,
                'reply' => $datum['reply'],
                'is_true' => isset($datum['is_true']) ? $datum['is_true'] : 0
            ];
        }

        ExerciseListenAnswerQuestionAnswer::insert($dataSave);

        return true;
    }
}
