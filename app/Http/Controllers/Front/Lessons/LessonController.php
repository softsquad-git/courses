<?php

namespace App\Http\Controllers\Front\Lessons;

use App\Http\Controllers\ApiController;
use App\Http\Resources\Courses\CourseLessonResource;
use App\Models\Courses\Lesson;
use App\Repositories\Courses\CourseLessonEndPageRepository;
use App\Repositories\Courses\CourseLessonRepository;
use Illuminate\Http\Request;
use \Exception;
use \Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use \Illuminate\Http\JsonResponse;

class LessonController extends ApiController
{
    public function __construct(
        private CourseLessonRepository        $courseLessonRepository,
        private CourseLessonEndPageRepository $courseLessonEndPageRepository
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

    /**
     * @param int $lessonId
     * @param int $courseId
     * @return JsonResponse
     */
    public function nextLesson(int $lessonId, int $courseId): JsonResponse
    {
        /**
         * @var Lesson|null $nextLesson
         */
        $nextLesson = $this->courseLessonRepository->findNextLesson($lessonId, $courseId);
        if (!$nextLesson) {
            return $this->successResponse('Brak kolejnej lekcji', [
                'code' => 444
            ]);
        }

        return $this->successResponse($nextLesson->name, [
            'lesson' => $nextLesson,
            'lessonId' => $nextLesson->id
        ]);
    }

    /**
     * @param int $lessonId
     * @return JsonResponse
     */
    public function getEndLesson(int $lessonId): JsonResponse
    {
        $item = $this->courseLessonEndPageRepository->findByOne(['lesson_id' => $lessonId]);

        if ($item) {
            $item->image = $item->getImage();
        }

        return $this->successResponse('', [
            'item' => $item
        ]);
    }
}
