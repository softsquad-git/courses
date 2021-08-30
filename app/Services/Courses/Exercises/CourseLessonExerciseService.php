<?php

namespace App\Services\Courses\Exercises;

use App\Models\Courses\Exercises\Exercise;
use App\Models\Courses\Exercises\ExerciseListenAnswerQuestion;
use App\Repositories\Courses\CourseLessonExerciseRepository;
use App\Repositories\Courses\CourseLessonRepository;
use App\Services\Courses\Exercises\Partials\ExerciseDataFieldsService;
use App\Services\Courses\Exercises\Partials\ExerciseDialogueService;
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

            $fields = $this->exerciseDataFieldsService->save(
                $data,
                $exercise
            );

            if (isset($data['speechBubble'])) {
                if (is_string($data['speechBubble'])) {
                    $data['speechBubble'] = json_decode($data['speechBubble'], true);
                }
                if (isset($data['speechBubble']) && count($data['speechBubble']) > 0 && !empty($data['speechBubble']['position']) && !empty($data['speechBubble']['content'])) {
                    $data['speechBubble']['exercise_id'] = $exercise->id;
                    $this->exerciseSpeechBubbleService->save($data['speechBubble']);
                }
            }

            if ($exercise->type == Exercise::$types['DIALOGUE']) {
                ExerciseDialogueService::save(json_decode($data['conversations'], true), $fields);
            }

            if (
                $exercise->type == Exercise::$types['LISTEN_ANSWER_QUESTION']
                ||
                $exercise->type == Exercise::$types['LISTEN_CHOOSE_ANSWER']
                ||
                $exercise->type == Exercise::$types['IMAGE_SELECT_ANSWER']
                ||
                $exercise->type == Exercise::$types['INDICATE_CORRECT_ANSWERS']
                ||
                $exercise->type == Exercise::$types['QUESTION_TRANS']
            ) {
                if (is_string($data['answers'])) {
                    $data['answers'] = json_decode($data['answers'], true);
                }
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
