<?php

namespace App\Http\Controllers\Admin\Settings;

use App\Http\Controllers\ApiController;
use App\Http\Controllers\Controller;
use App\Http\Requests\Settings\SettingAppRequest;
use App\Http\Resources\Settings\SettingAppResource;
use App\Repositories\Settings\SettingAppRepository;
use App\Services\Settings\SettingAppService;
use \Exception;
use Illuminate\Http\JsonResponse;
use \Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class SettingAppController extends Controller
{
    /**
     * @param SettingAppService $settingAppService
     * @param SettingAppRepository $settingAppRepository
     */
    public function __construct(
        private SettingAppService $settingAppService,
        private SettingAppRepository $settingAppRepository
    )
    { }

    public function index()
    {
        return view('admin.settings.index', [
            'title' => 'Ustawienia'
        ]);
    }

    public function application()
    {
        $settingsApp = $this->settingAppRepository->findAll();

        return view('admin.settings.app', [
            'title' => 'Ustawienia aplikacji',
            'settingsApp' => $settingsApp
        ]);
    }

    public function account()
    {
        return view('admin.settings.account', [
            'title' => 'Ustawienia konta'
        ]);
    }
}
