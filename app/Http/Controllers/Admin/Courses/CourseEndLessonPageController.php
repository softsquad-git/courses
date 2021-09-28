<?php

namespace App\Http\Controllers\Admin\Courses;

use App\Http\Controllers\Controller;
use App\Http\Requests\Lessons\LessonEndPageRequest;
use App\Repositories\Courses\CourseLessonEndPageRepository;
use App\Services\Courses\CourseLessonEndPageService;
use Illuminate\Http\Request;

class CourseEndLessonPageController extends Controller
{
    public function __construct(
        private CourseLessonEndPageRepository $courseLessonEndPageRepository,
        private CourseLessonEndPageService $courseLessonEndPageService
    )
    {
    }

    public function __invoke(LessonEndPageRequest $request)
    {
        if ($request->isMethod('POST')) {

        }
        return view('admin.courses.lessons.end_lesson_page', [
            'title' => 'Strona końcowa lekcji',
        ]);
    }
}
