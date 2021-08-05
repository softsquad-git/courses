<?php

namespace App\Http\Controllers\Admin\Home;

use App\Http\Controllers\Controller;
use App\Http\Requests\Home\HomeInformationImagesRequest;
use App\Models\Home\HomeInfoImages;
use App\Repositories\Home\HomeInformationImagesRepository;
use App\Services\Home\HomeInformationImageService;
use \Exception;
use \Illuminate\Contracts\View\View;
use \Illuminate\Contracts\View\Factory;
use \Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\RedirectResponse;

class HomeInformationImagesController extends Controller
{
    /**
     * @param HomeInformationImagesRepository $homeInformationImagesRepository
     * @param HomeInformationImageService $homeInformationImageService
     */
    public function __construct(
        private HomeInformationImagesRepository $homeInformationImagesRepository,
        private HomeInformationImageService $homeInformationImageService
    )
    {
    }

    /**
     * @return Application|Factory|View
     */
    public function index(): Application|Factory|View
    {
        $data = $this->homeInformationImagesRepository->findAll();

        return \view('admin.home.information_images.index', [
            'data' => $data,
            'title' => 'Strona główna'
        ]);
    }

    /**
     * @param HomeInformationImagesRequest $request
     * @return Application|Factory|View|RedirectResponse
     * @throws Exception
     */
    public function create(HomeInformationImagesRequest $request): Application|Factory|View|RedirectResponse
    {
        if ($request->isMethod('POST')) {
            $this->homeInformationImageService->save($request->all());

            return redirect()->route('admin.home.information_images.index');
        }

        return \view('admin.home.information_images.form', [
            'item' => new HomeInfoImages(),
            'title' => 'Dodaj sekcję strony głównej'
        ]);
    }

    /**
     * @param HomeInformationImagesRequest $request
     * @param int $id
     * @return Application|Factory|View|RedirectResponse
     * @throws Exception
     */
    public function update(HomeInformationImagesRequest $request, int $id): Application|Factory|View|RedirectResponse
    {
        $item = $this->homeInformationImagesRepository->find($id);
        if ($request->isMethod('POST')) {
            $this->homeInformationImageService->update($request->all(), $item);

            return redirect()->route('admin.home.information_images.index');
        }

        return \view('admin.home.information_images.form', [
            'item' => $item,
            'title' => 'Edytuj sekcję strony głównej'
        ]);
    }

    /**
     * @param int $id
     * @return RedirectResponse
     * @throws Exception
     */
    public function remove(int $id): RedirectResponse
    {
        $item = $this->homeInformationImagesRepository->find($id);
        $this->homeInformationImageService->remove($item);

        return redirect()->back();
    }
}
