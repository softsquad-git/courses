<?php

namespace App\Http\Controllers\Admin\Courses;

use App\Http\Controllers\Controller;
use App\Http\Requests\Courses\CourseRequest;
use App\Models\Courses\Course;
use App\Repositories\Courses\CourseRepository;
use App\Repositories\Languages\LanguageRepository;
use App\Repositories\Levels\LevelRepository;
use App\Services\Courses\CourseService;
use \Exception;
use \Illuminate\Contracts\View\View;
use \Illuminate\Contracts\View\Factory;
use \Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    /**
     * @param CourseRepository $courseRepository
     * @param CourseService $courseService
     * @param LanguageRepository $languageRepository
     * @param LevelRepository $levelRepository
     */
    public function __construct(
        private CourseRepository $courseRepository,
        private CourseService $courseService,
        private LanguageRepository $languageRepository,
        private LevelRepository $levelRepository
    )
    {}

    /**
     * @param Request $request
     * @return Application|Factory|View
     */
    public function all(Request $request): Application|Factory|View
    {
        $data = $this->courseRepository->findBy(
            $request->all(),
            $request->get('ordering', 'DESC'),
            $request->get('pagination', 20)
        );

        return view('admin.courses.index', [
            'title' => 'Kursy',
            'data' => $data
        ]);
    }

    /**
     * @param CourseRequest $request
     * @return Application|Factory|View|RedirectResponse
     * @throws Exception
     */
    public function create(CourseRequest $request):Application|Factory|View|RedirectResponse
    {
        if ($request->isMethod('POST')) {
            $this->courseService->save($request->all());

            return redirect()->route('admin.courses');
        }

        return view('admin.courses.form', [
            'item' => new Course(),
            'title' => 'Dodaj kurs',
            'levels' => $this->levelRepository->findAll(),
            'languages' => $this->languageRepository->findAll()
        ]);
    }

    /**
     * @param CourseRequest $request
     * @param int $id
     * @return Application|Factory|View|RedirectResponse
     * @throws Exception
     */
    public function update(CourseRequest $request, int $id): Application|Factory|View|RedirectResponse
    {
        $item = $this->courseRepository->find($id);
        if (!$item) {
            return $this->noPage();
        }
        if ($request->isMethod('POST')) {
            $this->courseService->update($request->all(), $item);

            return redirect()->route('admin.courses');
        }

        return view('admin.courses.form', [
            'title' => 'Edytuj kurs',
            'item' => $item,
            'levels' => $this->levelRepository->findAll(),
            'languages' => $this->languageRepository->findAll()
        ]);
    }

    /**
     * @param int $id
     * @return RedirectResponse
     * @throws Exception
     */
    public function remove(int $id): RedirectResponse
    {
        $item = $this->courseRepository->find($id);
        if (!$item) {
            return $this->noPage();
        }
        $this->courseService->remove($item);

        return redirect()->back();
    }
}
