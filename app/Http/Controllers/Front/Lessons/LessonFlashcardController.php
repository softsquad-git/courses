<?php

namespace App\Http\Controllers\Front\Lessons;

use App\Http\Controllers\ApiController;
use App\Http\Resources\Courses\CourseLessonExerciseResource;
use App\Models\Courses\Exercises\Exercise;
use App\Repositories\Courses\CourseLessonExerciseRepository;
use \Illuminate\Http\JsonResponse;

class LessonFlashcardController extends ApiController
{
    /**
     * @param CourseLessonExerciseRepository $courseLessonExerciseRepository
     */
    public function __construct(
        private CourseLessonExerciseRepository $courseLessonExerciseRepository
    )
    {
    }

    /**
     * @param int $lessonId
     * @return CourseLessonExerciseResource|JsonResponse
     */
    public function firstFlashcardByLesson(int $lessonId): CourseLessonExerciseResource|JsonResponse
    {
        $exercise = $this->courseLessonExerciseRepository->findOneBy([
            'lesson_id' => $lessonId,
            'type' => Exercise::$types['FLASHCARD']
        ]);

        if (!$exercise) {
            return $this->successResponse('Brak fiszek do tej lekcji', [
                'code' => 444
            ]);
        }

        return new CourseLessonExerciseResource($exercise);
    }

    /**
     * @param int $id
     * @return CourseLessonExerciseResource|JsonResponse
     */
    public function nextFlashcard(int $id): CourseLessonExerciseResource|JsonResponse
    {
        $exercise = $this->courseLessonExerciseRepository->next($id, Exercise::$types['FLASHCARD']);

        if (!$exercise) {
            return $this->successResponse('Brak następnej fiszki', [
                'code' => 444
            ]);
        }

        return new CourseLessonExerciseResource($exercise);
    }
}
