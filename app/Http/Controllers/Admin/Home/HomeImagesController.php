<?php

namespace App\Http\Controllers\Admin\Home;

use App\Http\Controllers\Controller;
use App\Http\Requests\Home\HomeImagesRequest;
use App\Repositories\Home\HomeImagesRepository;
use App\Services\Home\HomeImagesService;
use \Illuminate\Http\RedirectResponse;
use \Illuminate\Contracts\View\View;
use \Illuminate\Contracts\View\Factory;
use \Illuminate\Contracts\Foundation\Application;
use \Exception;

class HomeImagesController extends Controller
{
    /**
     * @param HomeImagesRepository $homeImagesRepository
     * @param HomeImagesService $homeImagesService
     */
    public function __construct(
        private HomeImagesRepository $homeImagesRepository,
        private HomeImagesService $homeImagesService
    )
    {
    }

    /**
     * @param HomeImagesRequest $request
     * @return Application|Factory|View|RedirectResponse
     * @throws Exception
     */
    public function index(HomeImagesRequest $request): Application|Factory|View|RedirectResponse
    {
        if ($request->isMethod('POST')) {
            $data = $request->all();
            $item = $this->homeImagesRepository->findOneBy(['position' => $data['position']]);
            if ($item) {
                $this->homeImagesService->remove($item);
            }

            $this->homeImagesService->save($data);

            return redirect()->back();
        }

        $data = $this->homeImagesRepository->findAll();

        return view('admin.home.images.index', [
            'data' => $data,
            'title' => 'Zdjęcia na stronie głównej'
        ]);
    }

    /**
     * @param int $id
     * @return RedirectResponse
     * @throws Exception
     */
    public function remove(int $id): RedirectResponse
    {
        $item = $this->homeImagesRepository->find($id);
        $this->homeImagesService->remove($item);

        return redirect()->back();
    }
}
