<?php

namespace App\Http\Controllers\Front\Courses;

use App\Http\Controllers\Controller;
use App\Repositories\Courses\CourseLessonRepository;
use App\Repositories\Levels\LevelRepository;
use Illuminate\Http\Request;

class LessonController extends Controller
{
    public function __construct(
        private CourseLessonRepository $courseLessonRepository,
        private LevelRepository $levelRepository
    )
    {
    }

    public function index(Request $request)
    {
        $lessons = $this->courseLessonRepository->findBy([]);
        $levels = $this->levelRepository->findAll();

        return view('front.account.lessons.index', [
            'lessons' => $lessons,
            'levels' => $levels
        ]);
    }
}
