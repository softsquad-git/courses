<?php

namespace App\Http\Controllers\Admin\Courses;

use App\Http\Controllers\Controller;
use App\Http\Requests\Courses\CourseLessonFlashcardRequest;
use App\Models\Courses\LessonFlashcard;
use App\Repositories\Courses\CourseLessonFlashcardsRepository;
use App\Services\Courses\CourseLessonFlashcardsService;
use \Exception;
use Illuminate\Http\RedirectResponse;
use \Illuminate\Contracts\View\View;
use \Illuminate\Contracts\View\Factory;
use \Illuminate\Contracts\Foundation\Application;

class CourseLessonFlashcardsController extends Controller
{
    /**
     * @param CourseLessonFlashcardsRepository $courseLessonFlashcardsRepository
     * @param CourseLessonFlashcardsService $courseLessonFlashcardsService
     */
    public function __construct(
        private CourseLessonFlashcardsRepository $courseLessonFlashcardsRepository,
        private CourseLessonFlashcardsService $courseLessonFlashcardsService
    )
    {
    }

    /**
     * @param int $lessonId
     * @return Application|Factory|View
     */
    public function index(int $lessonId): Application|Factory|View
    {
        $data = $this->courseLessonFlashcardsRepository->findBy([
            'lesson_id' => $lessonId
        ]);

        return view('admin.courses.lessons.flashcards.index', [
            'data' => $data,
            'title' => 'Fiszki',
            'lessonId' => $lessonId
        ]);
    }

    /**
     * @param CourseLessonFlashcardRequest $request
     * @param int $lessonId
     * @return Application|Factory|View|RedirectResponse
     * @throws Exception
     */
    public function create(CourseLessonFlashcardRequest $request, int $lessonId): Application|Factory|View|RedirectResponse
    {
        if ($request->isMethod('POST')) {
            $this->courseLessonFlashcardsService->save($request->all());

            return redirect()->route('admin.course.lessons.flashcards.index', ['lessonId' => $lessonId]);
        }

        return view('admin.courses.lessons.flashcards.form', [
            'item' => new LessonFlashcard(),
            'title' => 'Dodaj fiszkę',
            'lessonId' => $lessonId
        ]);
    }

    /**
     * @param CourseLessonFlashcardRequest $request
     * @param int $id
     * @return Application|Factory|View|RedirectResponse
     * @throws Exception
     */
    public function update(CourseLessonFlashcardRequest $request, int $id): Application|Factory|View|RedirectResponse
    {
        /**
         * @var LessonFlashcard $item
         */
        $item = $this->courseLessonFlashcardsRepository->find($id);
        if (!$item) {
            return $this->noPage();
        }

        if ($request->isMethod('POST')) {
            /**
             * @var LessonFlashcard $item
             */
            $item = $this->courseLessonFlashcardsService->update($request->all(), $item);

            return redirect()->route('admin.course.lessons.flashcards.index', ['lessonId' => $item->lesson_id]);
        }

        return view('admin.courses.lessons.flashcards.form', [
            'item' => $item,
            'title' => 'Edytuj fiszkę',
            'lessonId' => $item->lesson_id
        ]);
    }

    /**
     * @param int $id
     * @return RedirectResponse
     * @throws Exception
     */
    public function remove(int $id): RedirectResponse
    {
        $item = $this->courseLessonFlashcardsRepository->find($id);
        $this->courseLessonFlashcardsService->remove($item);

        return redirect()->back();
    }
}
