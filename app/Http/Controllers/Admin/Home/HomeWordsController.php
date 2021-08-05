<?php

namespace App\Http\Controllers\Admin\Home;

use App\Http\Controllers\Controller;
use App\Http\Requests\Home\HomeWordRequest;
use App\Models\Home\HomeWord;
use App\Repositories\Home\HomeWordRepository;
use App\Services\Home\HomeWordService;
use \Illuminate\Http\RedirectResponse;
use \Illuminate\Contracts\View\View;
use \Illuminate\Contracts\View\Factory;
use \Illuminate\Contracts\Foundation\Application;
use \Exception;

class HomeWordsController extends Controller
{
    /**
     * @param HomeWordRepository $homeWordRepository
     * @param HomeWordService $homeWordService
     */
    public function __construct(
        private HomeWordRepository $homeWordRepository,
        private HomeWordService $homeWordService
    )
    {}

    /**
     * @param HomeWordRequest $request
     * @param int|null $id
     * @return Application|Factory|View|RedirectResponse
     * @throws Exception
     */
    public function index(HomeWordRequest $request, ?int $id = null): Application|Factory|View|RedirectResponse
    {
        if ($request->isMethod('GET') && $id) {
            $item = $this->homeWordRepository->find($id);
            $data = $this->homeWordRepository->findAll();

            return \view('admin.home.words.index', [
                'data' => $data,
                'item' => $item,
                'title' => 'Edytuj słowo'
            ]);
        }
        if ($request->isMethod('POST')) {
            if ($id) {
                $item = $this->homeWordRepository->find($id);
                $this->homeWordService->update($request->all(), $item);

                return redirect()->route('admin.home.words.index');
            }
            $this->homeWordService->save($request->all());

            return redirect()->back();
        }

        $data = $this->homeWordRepository->findAll();

        return view('admin.home.words.index', [
            'data' => $data,
            'title' => 'Lista słów',
            'item' => new HomeWord()
        ]);
    }

    /**
     * @param int $id
     * @return RedirectResponse
     * @throws Exception
     */
    public function remove(int $id): RedirectResponse
    {
        $item = $this->homeWordRepository->find($id);
        $this->homeWordService->remove($item);

        return redirect()->back();
    }
}
