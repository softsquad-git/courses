<?php

namespace App\Http\Controllers\Admin\Courses;

use App\Http\Controllers\Controller;
use App\Http\Requests\Lessons\LessonEndPageRequest;
use App\Models\Lessons\EndLessonPage;
use App\Repositories\Courses\CourseLessonEndPageRepository;
use App\Services\Courses\CourseLessonEndPageService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Contracts\View\View;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\Foundation\Application;
use Exception;

class CourseEndLessonPageController extends Controller
{
    /**
     * @param CourseLessonEndPageRepository $courseLessonEndPageRepository
     * @param CourseLessonEndPageService $courseLessonEndPageService
     */
    public function __construct(
        private CourseLessonEndPageRepository $courseLessonEndPageRepository,
        private CourseLessonEndPageService    $courseLessonEndPageService
    )
    {
    }

    /**
     * @param LessonEndPageRequest $request
     * @param int $lessonId
     * @return Application|Factory|View|RedirectResponse
     * @throws Exception
     */
    public function __invoke(LessonEndPageRequest $request, int $lessonId): Application|Factory|View|RedirectResponse
    {
        if ($request->isMethod('POST')) {
            $item = $this->courseLessonEndPageRepository->findByOne(['lesson_id' => $lessonId]);
            if ($item) {
                $this->courseLessonEndPageService->save($request->all(), $item);
            }
            $this->courseLessonEndPageService->save($request->all());

            return redirect()->route('admin.course.lessons');
        }
        return view('admin.courses.lessons.end_lesson_page', [
            'title' => 'Strona końcowa lekcji',
            'item' => $this->courseLessonEndPageRepository->findByOne(['lesson_id' => $lessonId]) ?? new EndLessonPage(),
            'lessonId' => $lessonId
        ]);
    }
}
