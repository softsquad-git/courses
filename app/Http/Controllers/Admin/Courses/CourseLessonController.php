<?php

namespace App\Http\Controllers\Admin\Courses;

use App\Http\Controllers\Controller;
use App\Http\Requests\Courses\CourseLessonRequest;
use App\Models\Courses\Lesson;
use App\Repositories\Courses\CourseLessonRepository;
use App\Repositories\Courses\CourseRepository;
use App\Services\Courses\CourseLessonService;
use Illuminate\Http\Request;
use Exception;
use Illuminate\Contracts\View\View;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\RedirectResponse;

class CourseLessonController extends Controller
{
    /**
     * @param CourseLessonService $courseLessonService
     * @param CourseLessonRepository $courseLessonRepository
     * @param CourseRepository $courseRepository
     */
    public function __construct(
        private CourseLessonService $courseLessonService,
        private CourseLessonRepository $courseLessonRepository,
        private CourseRepository $courseRepository
    )
    {
    }

    /**
     * @param Request $request
     * @return Application|Factory|View
     */
    public function all(Request $request): Application|Factory|View
    {
        $data = $this->courseLessonRepository->findBy($request->all());

        return view('admin.courses.lessons.index', [
            'data' => $data,
            'title' => 'Lekcje'
        ]);
    }

    /**
     * @param CourseLessonRequest $request
     * @return Application|Factory|View|RedirectResponse
     * @throws Exception
     */
    public function create(CourseLessonRequest $request): Application|Factory|View|RedirectResponse
    {
        if ($request->isMethod('POST')) {
            $this->courseLessonService->save($request->all());

            return redirect()->route('admin.course.lessons');
        }

        return view('admin.courses.lessons.form', [
            'item' => new Lesson(),
            'title' => 'Dodaj lekcję',
            'courses' => $this->courseRepository->findAll()
        ]);
    }

    /**
     * @param CourseLessonRequest $request
     * @param int $id
     * @return Application|Factory|View|RedirectResponse
     * @throws Exception
     */
    public function update(CourseLessonRequest $request, int $id): Application|Factory|View|RedirectResponse
    {
        $item = $this->courseLessonRepository->find($id);
        if (!$item) {
            return $this->noPage();
        }

        if ($request->isMethod('POST')) {
            $this->courseLessonService->update($request->all(), $item);

            return redirect()->route('admin.course.lessons');
        }

        return view('admin.courses.lessons.form', [
            'item' => $item,
            'title' => 'Edytuj lekcję',
            'courses' => $this->courseRepository->findAll()
        ]);
    }

    /**
     * @param int $id
     * @return RedirectResponse
     * @throws Exception
     */
    public function remove(int $id): RedirectResponse
    {
        $item = $this->courseLessonRepository->find($id);
        if (!$item) {
            return $this->noPage();
        }
        $this->courseLessonService->remove($item);

        return redirect()->back();
    }
}
