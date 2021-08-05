<?php

namespace App\Http\Controllers\Admin\Home;

use App\Http\Controllers\Controller;
use App\Http\Requests\Home\HomeInformationRequest;
use App\Models\Home\HomeInfo;
use App\Repositories\Home\HomeInformationRepository;
use App\Services\Home\HomeInformationService;
use \Exception;
use \Illuminate\Contracts\View\View;
use \Illuminate\Contracts\View\Factory;
use \Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\RedirectResponse;

class HomeInformationController extends Controller
{
    /**
     * @param HomeInformationRepository $homeInformationRepository
     * @param HomeInformationService $homeInformationService
     */
    public function __construct(
        private HomeInformationRepository $homeInformationRepository,
        private HomeInformationService $homeInformationService
    )
    {
    }

    /**
     * @return Application|Factory|View
     */
    public function index(): Application|Factory|View
    {
        $data = $this->homeInformationRepository->findAll();

        return view('admin.home.information.index', [
            'title' => 'Strona główna',
            'data' => $data
        ]);
    }

    /**
     * @param HomeInformationRequest $request
     * @return Application|Factory|View|RedirectResponse
     * @throws Exception
     */
    public function create(HomeInformationRequest $request): Application|Factory|View|RedirectResponse
    {
        if ($request->isMethod('POST')) {
            $this->homeInformationService->save($request->all());

            return redirect()->route('admin.home.information.index');
        }

        return \view('admin.home.information.form', [
            'item' => new HomeInfo(),
            'title' => 'Dodaj sekcję strony głównej'
        ]);
    }

    /**
     * @param HomeInformationRequest $request
     * @param int $id
     * @return Application|Factory|View|RedirectResponse
     * @throws Exception
     */
    public function update(HomeInformationRequest $request, int $id): Application|Factory|View|RedirectResponse
    {
        $item = $this->homeInformationRepository->find($id);
        if ($request->isMethod('POST')) {
            $this->homeInformationService->update($request->all(), $item);

            return redirect()->route('admin.home.information.index');
        }

        return \view('admin.home.information.form', [
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
        $item = $this->homeInformationRepository->find($id);
        $this->homeInformationService->remove($item);

        return redirect()->back();
    }
}
