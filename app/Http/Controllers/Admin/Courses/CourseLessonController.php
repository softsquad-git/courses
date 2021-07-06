<?php

namespace App\Http\Controllers\Admin\Courses;

use App\Http\Controllers\ApiController;
use App\Http\Requests\Courses\CourseLessonRequest;
use App\Http\Resources\Courses\CourseLessonResource;
use App\Repositories\Courses\CourseLessonRepository;
use App\Services\Courses\CourseLessonService;
use Illuminate\Http\Request;
use \Exception;
use Illuminate\Http\JsonResponse;
use \Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class CourseLessonController extends ApiController
{
    /**
     * @param CourseLessonService $courseLessonService
     * @param CourseLessonRepository $courseLessonRepository
     */
    public function __construct(
        private CourseLessonService $courseLessonService,
        private CourseLessonRepository $courseLessonRepository
    )
    {
    }

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
     * @param CourseLessonRequest $request
     * @return JsonResponse
     */
    public function create(CourseLessonRequest $request): JsonResponse
    {
        try {
            $this->courseLessonService->save($request->all());

            return $this->createdResponse();
        } catch (Exception $e) {
            return $this->errorResponse($e);
        }
    }

    /**
     * @param CourseLessonRequest $request
     * @param int $id
     * @return JsonResponse
     */
    public function update(CourseLessonRequest $request, int $id): JsonResponse
    {
        try {
            $item = $this->courseLessonRepository->find($id);
            $this->courseLessonService->update($request->all(), $item);

            return $this->createdResponse();
        } catch (Exception $e) {
            return $this->errorResponse($e);
        }
    }

    /**
     * @param int $id
     * @return JsonResponse
     */
    public function remove(int $id): JsonResponse
    {
        try {
            $item = $this->courseLessonRepository->find($id);
            $this->courseLessonService->remove($item);

            return $this->deletedResponse();
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
