<?php

namespace App\Http\Controllers\Front\Levels;

use App\Http\Controllers\ApiController;
use App\Http\Resources\Levels\LevelResource;
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
        private LevelRepository $levelRepository,
        private CourseRepository $courseRepository
    )
    {}

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
}
