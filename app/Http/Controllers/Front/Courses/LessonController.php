<?php

namespace App\Http\Controllers\Front\Courses;

use App\Http\Controllers\ApiController;
use App\Http\Controllers\Controller;
use App\Models\Courses\Exercises\Exercise;
use App\Repositories\Courses\CourseLessonExerciseRepository;
use App\Repositories\Courses\CourseLessonProgressRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LessonController extends ApiController
{
    public function __construct(
        private CourseLessonProgressRepository $courseLessonProgressRepository,
        private CourseLessonExerciseRepository $courseLessonExerciseRepository
    )
    {
    }

    public function getUserLessonInfo(Request $request): JsonResponse
    {
        $lessonId = $request->get('lesson_id');
        if (!$lessonId) {
            return $this->badResponse('Brak parametru');
        }

        $exerciseId = $this->courseLessonProgressRepository->maxExerciseId(
            Auth::id(),
            $lessonId
        );

        $nextPosition = 0;

        if ($exerciseId != 0) {
            /**
             * @var Exercise $exercise
             */
            $exercise = $this->courseLessonExerciseRepository->find($exerciseId);

            $nextPosition = $exercise->position + 1;
        }

        return $this->successResponse('', [
            'nextPosition' => $nextPosition
        ]);
    }
}
