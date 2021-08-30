<?php

namespace App\Http\Controllers\Admin\Pages;

use App\Http\Controllers\Controller;
use App\Http\Requests\Pages\StaticPageRequest;
use App\Models\Pages\StaticPage;
use App\Repositories\Pages\StaticPageRepository;
use App\Services\Pages\StaticPageService;
use \Illuminate\Contracts\Foundation\Application;
use \Illuminate\Contracts\View\Factory;
use \Illuminate\Contracts\View\View;
use \Illuminate\Http\RedirectResponse;
use \Exception;

class StaticPageController extends Controller
{
    /**
     * @param StaticPageRepository $staticPageRepository
     * @param StaticPageService $staticPageService
     */
    public function __construct(
        private StaticPageRepository $staticPageRepository,
        private StaticPageService $staticPageService
    )
    {
    }

    /**
     * @return Application|Factory|View
     */
    public function index(): Application|Factory|View
    {
        $data = $this->staticPageRepository->findAll();

        return view('admin.pages.index', [
            'data' => $data,
            'title' => 'Strony statyczne'
        ]);
    }

    /**
     * @param StaticPageRequest $request
     * @param int $id
     * @return Application|Factory|View|RedirectResponse
     * @throws Exception
     */
    public function update(StaticPageRequest $request, int $id): Application|Factory|View|RedirectResponse
    {
        $item = $this->staticPageRepository->find($id);

        if ($request->isMethod('POST')) {
            $this->staticPageService->update($request->all(), $item);

            return redirect()->route('admin.pages.static_pages.index');
        }

        return view('admin.pages.form', [
            'item' => $item,
            'title' => 'Edytuj stronę'
        ]);
    }
}
