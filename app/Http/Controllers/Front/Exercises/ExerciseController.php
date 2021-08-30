<?php

namespace App\Http\Controllers\Front\Exercises;

use App\Http\Controllers\ApiController;
use App\Http\Resources\Courses\CourseLessonExerciseResource;
use App\Models\Courses\Exercises\Exercise;
use App\Repositories\Courses\CourseLessonExerciseRepository;
use App\Services\Courses\UserLessonExerciseProgress;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use \Exception;
use Illuminate\Support\Facades\Auth;

class ExerciseController extends ApiController
{
    public function __construct(
        private CourseLessonExerciseRepository $courseLessonExerciseRepository,
        private UserLessonExerciseProgress $userLessonExerciseProgress
    ){}

    /**
     * @param Request $request
     * @return CourseLessonExerciseResource|JsonResponse
     */
    public function find(Request $request): CourseLessonExerciseResource|JsonResponse
    {
        try {
            $lessonId = $request->get('lessonId');
            $positionExercise = $request->get('positionExercise');
            $isCurrent = $request->get('isCurrent');
            $type = $request->get('type', null);

            if (filter_var($isCurrent, FILTER_VALIDATE_BOOLEAN, FILTER_NULL_ON_FAILURE) === false) {
                $positionExercise = $positionExercise + 1;
            }

            /**
             * @var Exercise $exercise
             */
            $exercise = $this->courseLessonExerciseRepository->findExercise($lessonId, $positionExercise, $type);

            if (!$exercise) {
                return response()->json([
                    'status' => 222
                ]);
            }

            if (filter_var($isCurrent, FILTER_VALIDATE_BOOLEAN, FILTER_NULL_ON_FAILURE) === false) {
                $this->userLessonExerciseProgress->save([
                    'lesson_id' => $lessonId,
                    'exercise_id' => $exercise->id,
                    'user_id' => Auth::id()
                ]);
            }

            return new CourseLessonExerciseResource($exercise);
        } catch (Exception $e) {
            return $this->errorResponse($e);
        }
    }
}
