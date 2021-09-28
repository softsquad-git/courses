<?php

namespace App\Http\Controllers\Admin\Courses;

use App\Http\Controllers\Controller;
use App\Http\Requests\Courses\CourseLessonExerciseRequest;
use App\Http\Resources\Courses\CourseLessonExercisesResource;
use App\Models\Courses\Exercises\Exercise;
use App\Models\Courses\Lesson;
use App\Repositories\Courses\CourseLessonExerciseRepository;
use App\Services\Courses\Exercises\CourseLessonExerciseService;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use \Exception;
use \Illuminate\Contracts\View\View;
use \Illuminate\Contracts\View\Factory;
use \Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\RedirectResponse;

class CourseLessonExerciseController extends Controller
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
     * @param int $lessonId
     * @return Application|Factory|View
     */
    public function all(Request $request, int $lessonId): Application|Factory|View
    {
        $filters = $request->all();
        $filters['lesson_id'] = $lessonId;
        $data = $this->courseLessonExerciseRepository->findBy($filters);

        return \view('admin.courses.lessons.exercises.index', [
            'data' => $data,
            'title' => 'Ćwiczenia do lekcji',
            'lessonId' => $lessonId
        ]);
    }

    /**
     * @param CourseLessonExerciseRequest $request
     * @param int $lessonId
     * @return Application|Factory|View|JsonResponse
     * @throws Exception
     */
    public function create(CourseLessonExerciseRequest $request, int $lessonId): JsonResponse|Application|Factory|View
    {
        if ($request->isMethod('POST')) {
            $this->courseLessonExerciseService->save($request->all());

            return response()->json([
                'success' => 1
            ], 201);
        }

        return \view('admin.courses.lessons.exercises.form', [
            'item' => new Exercise(),
            'title' => 'Utwórz ćwiczenie',
            'lessonId' => $lessonId
        ]);
    }

    /**
     * @param CourseLessonExerciseRequest $request
     * @param int $id
     * @return Application|Factory|View|RedirectResponse
     * @throws Exception
     */
    public function update(CourseLessonExerciseRequest $request, int $id): Application|Factory|View|RedirectResponse
    {
        /**
         * @var Exercise $item
         */
        $item = $this->courseLessonExerciseRepository->find($id);
        if ($request->isMethod('POST')) {

        }

        return view('admin.courses.lessons.exercises.form', [
            'item' => $item,
            'title' => 'Edytuj ćwiczenie',
            'lessonId' => $item->lesson_id,
        ]);
    }

    /**
     * @param int $id
     * @return RedirectResponse
     * @throws Exception
     */
    public function remove(int $id): RedirectResponse
    {
        /**
         * @var Exercise $item
         */
        $item = $this->courseLessonExerciseRepository->find($id);
        $this->courseLessonExerciseService->remove($item);

        return redirect()->back();
    }
}
