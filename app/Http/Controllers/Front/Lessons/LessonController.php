<?php

namespace App\Http\Controllers\Front\Lessons;

use App\Http\Controllers\ApiController;
use App\Http\Resources\Courses\CourseLessonResource;
use App\Repositories\Courses\CourseLessonRepository;
use Illuminate\Http\Request;
use \Exception;
use \Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use \Illuminate\Http\JsonResponse;

class LessonController extends ApiController
{
    public function __construct(
        private CourseLessonRepository $courseLessonRepository
    )
    {}

    /**
     * @param Request $request
     * @return JsonResponse|AnonymousResourceCollection
     */
    public function all(Request $request): JsonResponse|AnonymousResourceCollection
    {
        try {
            $data = $this->courseLessonRepository->findBy($request->all());

            return CourseLessonResource::collection($data);
        } catch (Exception $e) {
            return $this->errorResponse($e);
        }
    }

    /**
     * @param int $id
     * @return JsonResponse|CourseLessonResource
     */
    public function find(int $id): JsonResponse|CourseLessonResource
    {
        try {
            $item = $this->courseLessonRepository->find($id);

            return new CourseLessonResource($item);
        } catch (Exception $e) {
            return $this->errorResponse($e);
        }
    }
}
