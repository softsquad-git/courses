<?php

namespace App\Http\Controllers\Admin\Courses;

use App\Http\Controllers\ApiController;
use App\Http\Requests\Courses\CourseLessonImageRequest;
use App\Http\Resources\Courses\CourseLessonImagesResource;
use App\Models\Courses\Lesson;
use App\Repositories\Courses\CourseLessonImageRepository;
use App\Services\Courses\CourseLessonImageService;
use Illuminate\Http\JsonResponse;
use \Exception;
use Illuminate\Http\Request;

class CourseLessonImagesController extends ApiController
{
    /**
     * @param CourseLessonImageRepository $courseLessonImageRepository
     * @param CourseLessonImageService $courseLessonImageService
     */
    public function __construct(
        private CourseLessonImageRepository $courseLessonImageRepository,
        private CourseLessonImageService $courseLessonImageService
    )
    {
    }

    /**
     * @return JsonResponse
     */
    public function all(): JsonResponse
    {
        $data = $this->courseLessonImageRepository->getAll();

        $results = [];
        foreach ($data as $datum) {
            $results[] = [
                'link' => asset(Lesson::$fileDir.$datum),
                'src' => $datum
            ];
        }

        return $this->successResponse('', [
            'files' => $results
        ]);
    }

    /**
     * @param CourseLessonImageRequest $request
     * @return JsonResponse
     */
    public function upload(CourseLessonImageRequest $request): JsonResponse
    {
        try {
            $this->courseLessonImageService->upload($request->file('files'));

            return $this->createdResponse();
        } catch (Exception $e) {
            return $this->errorResponse($e);
        }
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function remove(Request $request): JsonResponse
    {
        try {
            $this->courseLessonImageService->remove([]);

            return $this->deletedResponse();
        } catch (Exception $e) {
            return $this->errorResponse($e);
        }
    }
}
