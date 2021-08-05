<?php

namespace App\Http\Controllers\Admin\Courses;

use App\Http\Controllers\ApiController;
use App\Http\Controllers\Controller;
use App\Http\Requests\Courses\LevelRequest;
use App\Http\Resources\Levels\LevelResource;
use App\Models\Courses\Level;
use App\Repositories\Levels\LevelRepository;
use App\Services\Levels\LevelService;
use \Exception;
use \Illuminate\Contracts\View\View;
use \Illuminate\Contracts\View\Factory;
use \Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\RedirectResponse;

class LevelController extends Controller
{
    /**
     * @param LevelRepository $levelRepository
     * @param LevelService $levelService
     */
    public function __construct(
        private LevelRepository $levelRepository,
        private LevelService $levelService
    )
    {
    }

    /**
     * @return Application|Factory|View
     */
    public function all(): Application|Factory|View
    {
        $data = $this->levelRepository->findAll();

        return view('admin.courses.levels.index', [
            'data' => $data,
            'title' => 'Poziomy trudności'
        ]);
    }

    /**
     * @param LevelRequest $request
     * @return Application|View|Factory|RedirectResponse
     */
    public function create(LevelRequest $request): Application|View|Factory|RedirectResponse
    {
        if ($request->isMethod('POST')) {
            $this->levelService->save($request->all());

            return redirect()->route('admin.course.levels');
        }

        return view('admin.courses.levels.form', [
            'item' => new Level(),
            'title' => 'Dodaj poziom trudności'
        ]);
    }

    /**
     * @param LevelRequest $request
     * @param int $id
     * @return Application|Factory|View|RedirectResponse
     * @throws Exception
     */
    public function update(LevelRequest $request, int $id): Application|Factory|View|RedirectResponse
    {
        $item = $this->levelRepository->find($id);
        if (!$item) {
            return $this->noPage();
        }
        if ($request->isMethod('POST')) {
            $this->levelService->update($request->all(), $item);

            return redirect()->route('admin.course.levels');
        }

        return view('admin.courses.levels.form', [
            'item' => $item,
            'title' => 'Edytuj poziom trudności'
        ]);
    }

    /**
     * @param int $id
     * @return RedirectResponse
     * @throws Exception
     */
    public function remove(int $id): RedirectResponse
    {
        $item = $this->levelRepository->find($id);
        if (!$item) {
            return $this->noPage();
        }
        $this->levelService->remove($item);

        return redirect()->route('admin.course.levels');
    }
}
