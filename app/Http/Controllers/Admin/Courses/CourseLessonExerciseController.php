<?php

namespace App\Http\Controllers\Admin\Courses;

use App\Http\Controllers\ApiController;
use App\Http\Requests\Courses\CourseLessonExerciseRequest;
use App\Http\Resources\Courses\CourseLessonExercisesResource;
use App\Repositories\Courses\CourseLessonExerciseRepository;
use App\Services\Courses\Exercises\CourseLessonExerciseService;
use Illuminate\Http\JsonResponse;
use \Exception;
use Illuminate\Http\Request;
use \Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class CourseLessonExerciseController extends ApiController
{
    /**
     * @param CourseLessonExerciseRepository $courseLessonExerciseRepository
     * @param CourseLessonExerciseService $courseLessonExerciseService
     */
    public function __construct(
        private CourseLessonExerciseRepository $courseLessonExerciseRepository,
        private CourseLessonExerciseService $courseLessonExerciseService
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
            $data = $this->courseLessonExerciseRepository->findBy($request->all());

            return CourseLessonExercisesResource::collection($data);
        } catch (Exception $e) {
            return $this->errorResponse($e);
        }
    }

    /**
     * @param int $id
     * @return CourseLessonExercisesResource|JsonResponse
     */
    public function find(int $id): CourseLessonExercisesResource|JsonResponse
    {
        try {
            $item = $this->courseLessonExerciseRepository->find($id);

            return new CourseLessonExercisesResource($item);
        } catch (Exception $e) {
            return $this->errorResponse($e);
        }
    }

    /**
     * @param CourseLessonExerciseRequest $request
     * @return JsonResponse
     */
    public function create(CourseLessonExerciseRequest $request): JsonResponse
    {
        try {
            $this->courseLessonExerciseService->save($request->all());

            return $this->createdResponse();
        } catch (Exception $e) {
            return $this->errorResponse($e);
        }
    }

    public function update(CourseLessonExerciseRequest $request, int $id): JsonResponse
    {
        try {
            $item = $this->courseLessonExerciseRepository->find($id);

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
            $item = $this->courseLessonExerciseRepository->find($id);
            $this->courseLessonExerciseService->remove($item);

            return $this->deletedResponse();
        } catch (Exception $e) {
            return $this->errorResponse($e);
        }
    }
}
