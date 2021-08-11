<?php

namespace App\Http\Controllers\Front\Settings;

use App\Http\Controllers\ApiController;
use App\Repositories\Settings\SettingAppRepository;
use \Illuminate\Http\JsonResponse;

class SettingController extends ApiController
{
    /**
     * @param SettingAppRepository $settingAppRepository
     */
    public function __construct(
        private SettingAppRepository $settingAppRepository
    )
    {
    }

    /**
     * @return JsonResponse
     */
    public function __invoke(): JsonResponse
    {
        $data = $this->settingAppRepository->findAll();

        $items = [];
        foreach ($data as $datum) {
            $items[$datum->name] = $datum->value;
        }

        return $this->successResponse('Ustawienia aplikacji', [
            'data' => $items
        ]);
    }
}
