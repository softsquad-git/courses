<?php

namespace App\Services\Courses\Exercises;

use App\Models\Courses\Exercises\Exercise;
use App\Models\Courses\Exercises\ExerciseListenAnswerQuestion;
use App\Services\Courses\Exercises\Partials\ExerciseDataFieldsService;
use App\Services\Courses\Exercises\Partials\ExerciseQuestionAnswersService;
use Illuminate\Support\Facades\DB;
use \Exception;

class CourseLessonExerciseService
{

    public function __construct(
        private ExerciseDataFieldsService $exerciseDataFieldsService,
        private ExerciseQuestionAnswersService $exerciseQuestionAnswersService
    )
    {
    }

    /**
     * @param array $data
     * @return Exercise
     * @throws Exception
     */
    public function save(array $data): Exercise
    {
        DB::beginTransaction();
        try {
            $exercise = Exercise::create($data);

            $dataFields = $data['fields'];
            $fields = $this->exerciseDataFieldsService->save(
                $dataFields,
                $exercise
            );

            if (
                $exercise->type == Exercise::$types['LISTEN_ANSWER_QUESTION']
                ||
                $exercise->type == Exercise::$types['LISTEN_CHOOSE_ANSWER']
            ) {
                $this->exerciseQuestionAnswersService->save($dataFields['answers'], $fields);
            }

            DB::commit();

            return $exercise;
        } catch (Exception $e) {
            DB::rollBack();
            throw new Exception($e);
        }
    }

    /**
     * @param Exercise $exercise
     * @return bool|null
     */
    public function remove(Exercise $exercise): ?bool
    {
        return $exercise->delete();
    }
}
