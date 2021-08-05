<?php

namespace App\Http\Controllers\Front\Courses;

use App\Http\Controllers\ApiController;
use App\Repositories\Courses\CourseLessonRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CourseController extends ApiController
{
    public function __construct(
        private CourseLessonRepository $courseLessonRepository
    )
    {}

    /**
     * @param int $courseId
     * @return JsonResponse
     */
    public function getStat(int $courseId): JsonResponse
    {
        $allLessons = $this->courseLessonRepository->findBy([
            'course_id' => $courseId
        ]);

        return $this->successResponse('', [
           'countAllLessons' => $allLessons->count()
        ]);
    }
}
