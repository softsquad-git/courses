<?php

namespace App\Http\Controllers\Admin\Languages;

use App\Http\Controllers\Controller;
use App\Http\Requests\Languages\LanguageRequest;
use App\Models\Languages\Language;
use App\Repositories\Languages\LanguageRepository;
use App\Services\Languages\LanguageService;
use \Exception;
use \Illuminate\Contracts\View\View;
use \Illuminate\Contracts\View\Factory;
use \Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\RedirectResponse;

class LanguageController extends Controller
{
    /**
     * @param LanguageService $languageService
     * @param LanguageRepository $languageRepository
     */
    public function __construct(
        private LanguageService $languageService,
        private LanguageRepository $languageRepository
    )
    {}

    /**
     * @return Application|Factory|View
     */
    public function all(): Application|Factory|View
    {
        $data = $this->languageRepository->findAll();

        return view('admin.languages.index', [
            'title' => 'Języki',
            'data' => $data
        ]);
    }

    /**
     * @param LanguageRequest $request
     * @return Application|Factory|View|RedirectResponse
     */
    public function create(LanguageRequest $request): Application|Factory|View|RedirectResponse
    {
        if ($request->isMethod('POST')) {
            $this->languageService->save($request->all());

            return redirect()->route('admin.languages');
        }

        return view('admin.languages.form', [
            'item' => new Language(),
            'title' => 'Dodaj język'
        ]);
     }

    /**
     * @param LanguageRequest $request
     * @param int $id
     * @return Application|Factory|View|RedirectResponse
     * @throws Exception
     */
    public function update(LanguageRequest $request, int $id): Application|Factory|View|RedirectResponse
    {
        $item = $this->languageRepository->find($id);
        if (!$item) {
            return $this->noPage();
        }
        if ($request->isMethod('POST')) {
            $this->languageService->save($request->all());

            return redirect()->route('admin.languages');
        }

        return view('admin.languages.form', [
            'item' => $item,
            'title' => 'Edytuj dane języka'
        ]);
    }

    /**
     * @param int $id
     * @return RedirectResponse
     * @throws Exception
     */
    public function remove(int $id): RedirectResponse
    {
        $item = $this->languageRepository->find($id);
        if (!$item) {
            return $this->noPage();
        }
        $this->languageService->remove($item);

        return redirect()->route('admin.languages');
    }
}
