<?php

namespace App\Http\Controllers\Front\Levels;

use App\Http\Controllers\ApiController;
use App\Http\Resources\Levels\LevelResource;
use App\Models\Courses\Course;
use App\Models\Courses\Level;
use App\Repositories\Courses\CourseRepository;
use App\Repositories\Levels\LevelRepository;
use \Exception;
use \Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\JsonResponse;

class LevelController extends ApiController
{
    /**
     * @param LevelRepository $levelRepository
     * @param CourseRepository $courseRepository
     */
    public function __construct(
        private LevelRepository  $levelRepository,
        private CourseRepository $courseRepository
    )
    {
    }

    /**
     * @return JsonResponse|AnonymousResourceCollection
     */
    public function __invoke(): JsonResponse|AnonymousResourceCollection
    {
        try {
            $data = $this->levelRepository->findAll();

            return LevelResource::collection($data);
        } catch (Exception $e) {
            return $this->errorResponse($e);
        }
    }

    /**
     * @param int $id
     * @return JsonResponse
     */
    public function changeLevel(int $id): JsonResponse
    {
        try {
            /**
             * @var Course|null $course
             */
            $course = $this->courseRepository->findOneBy([
                'level_id' => $id
            ]);

            if (!$course) {
                return $this->badResponse('Brak kursu dla wybranego poziomu');
            }

            return $this->successResponse('', [
                'courseId' => $course->id
            ]);
        } catch (Exception $e) {
            return $this->errorResponse($e);
        }
    }

    /**
     * @return JsonResponse
     */
    public function defaultLevel(): JsonResponse
    {
        /**
         * @var Level $item
         */
        $item = $this->levelRepository->findOneBy([
            'is_default' => 1
        ]);

        /**
         * @var Course|null $course
         */
        $course = $this->courseRepository->findOneBy([
            'level_id' => $item->id
        ]);

        return $this->successResponse('Domyślny poziom', [
            'item' => $item,
            'courseId' => $course->id
        ]);
    }

    /**
     * @param int $levelId
     * @return JsonResponse
     */
    public function nextLevel(int $levelId): JsonResponse
    {
        $next = Level::where('id', '>', $levelId)->min('position');

        if ($next) {
            $nextLevel = Level::where('position', $next)->first();

            $course = $this->courseRepository->findOneBy(['level_id' => $nextLevel->id]);

            if (!$course) {
                return $this->badResponse('no_course_next_level');
            }

            return $this->successResponse('', [
                'courseId' => $course->id,
                'level' => $nextLevel
            ]);
        }

        return $this->badResponse('last_level');
    }
}
