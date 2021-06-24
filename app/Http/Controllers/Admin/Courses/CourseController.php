<?php

namespace App\Http\Controllers\Admin\Courses;

use App\Http\Controllers\ApiController;
use App\Http\Requests\Courses\CourseRequest;
use App\Http\Resources\Courses\CourseResource;
use App\Http\Resources\Courses\CoursesResource;
use App\Repositories\Courses\CourseRepository;
use App\Services\Courses\CourseService;
use \Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use \Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class CourseController extends ApiController
{
    /**
     * @var CourseRepository $courseRepository
     */
    private CourseRepository $courseRepository;

    /**
     * @var CourseService $courseService
     */
    private CourseService $courseService;

    /**
     * @param CourseRepository $courseRepository
     * @param CourseService $courseService
     */
    public function __construct(
        CourseRepository $courseRepository,
        CourseService $courseService
    )
    {
        $this->courseRepository = $courseRepository;
        $this->courseService = $courseService;
    }

    /**
     * @param Request $request
     * @return AnonymousResourceCollection|JsonResponse
     */
    public function all(Request $request): AnonymousResourceCollection|JsonResponse
    {
        try {
            $data = $this->courseRepository->findBy(
                $request->all(),
                $request->get('ordering', 'DESC'),
                $request->get('pagination', 20)
            );

            return CoursesResource::collection($data);
        } catch (Exception $e) {
            return $this->errorResponse($e);
        }
    }

    /**
     * @param int $id
     * @return CourseResource|JsonResponse
     */
    public function find(int $id): CourseResource|JsonResponse
    {
        try {
            $item = $this->courseRepository->find($id);

            return new CourseResource($item);
        } catch (Exception $e) {
            return $this->errorResponse($e);
        }
    }

    /**
     * @param CourseRequest $request
     * @return JsonResponse
     */
    public function create(CourseRequest $request): JsonResponse
    {
        try {
            $this->courseService->save($request->all());

            return $this->createdResponse();
        } catch (Exception $e) {
            return $this->errorResponse($e);
        }
    }

    /**
     * @param CourseRequest $request
     * @param int $id
     * @return JsonResponse
     */
    public function update(CourseRequest $request, int $id): JsonResponse
    {
        try {
            $item = $this->courseRepository->find($id);
            $this->courseService->update($request->all(), $item);

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
            $item = $this->courseRepository->find($id);
            $this->courseService->remove($item);

            return $this->deletedResponse();
        } catch (Exception $e) {
            return $this->errorResponse($e);
        }
    }
}
