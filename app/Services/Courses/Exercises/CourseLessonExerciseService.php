<?php

namespace App\Services\Courses\Exercises;

use App\Models\Courses\Exercises\Exercise;
use App\Models\Courses\Exercises\ExerciseListenAnswerQuestion;
use App\Repositories\Courses\CourseLessonExerciseRepository;
use App\Repositories\Courses\CourseLessonRepository;
use App\Services\Courses\Exercises\Partials\ExerciseDataFieldsService;
use App\Services\Courses\Exercises\Partials\ExerciseQuestionAnswersService;
use Illuminate\Support\Facades\DB;
use \Exception;

class CourseLessonExerciseService
{
    public function __construct(
        private ExerciseDataFieldsService $exerciseDataFieldsService,
        private ExerciseQuestionAnswersService $exerciseQuestionAnswersService,
        private CourseLessonExerciseRepository $courseLessonExerciseRepository,
        private ExerciseSpeechBubbleService $exerciseSpeechBubbleService
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
            $data['position'] = $this->courseLessonExerciseRepository->getMaxPosition($data['lesson_id']) + 1;
            $exercise = Exercise::create($data);

            $dataFields = $data['exercise'];
            $fields = $this->exerciseDataFieldsService->save(
                $dataFields,
                $exercise
            );

            if (isset($data['speechBubble']) && count($data['speechBubble']) > 0) {
                $data['speechBubble']['exercise_id'] = $exercise->id;
                $this->exerciseSpeechBubbleService->save($data);
            }

            if (
                $exercise->type == Exercise::$types['LISTEN_ANSWER_QUESTION']
                ||
                $exercise->type == Exercise::$types['LISTEN_CHOOSE_ANSWER']
                ||
                $exercise->type == Exercise::$types['IMAGE_SELECT_ANSWER']
                ||
                $exercise->type == Exercise::$types['INDICATE_CORRECT_ANSWERS']
            ) {
                $this->exerciseQuestionAnswersService->save($data['answers'], $fields);
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
