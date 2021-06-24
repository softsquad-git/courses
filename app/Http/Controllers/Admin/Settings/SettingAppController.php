<?php

namespace App\Http\Controllers\Admin\Settings;

use App\Http\Controllers\ApiController;
use App\Http\Requests\Settings\SettingAppRequest;
use App\Http\Resources\Settings\SettingAppResource;
use App\Repositories\Settings\SettingAppRepository;
use App\Services\Settings\SettingAppService;
use \Exception;
use Illuminate\Http\JsonResponse;
use \Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class SettingAppController extends ApiController
{
    /**
     * @var SettingAppRepository $settingAppRepository
     */
    private SettingAppRepository $settingAppRepository;

    /**
     * @var SettingAppService $settingAppService
     */
    private SettingAppService $settingAppService;

    /**
     * @param SettingAppService $settingAppService
     * @param SettingAppRepository $settingAppRepository
     */
    public function __construct(
        SettingAppService $settingAppService,
        SettingAppRepository $settingAppRepository
    )
    {
        $this->settingAppRepository = $settingAppRepository;
        $this->settingAppService = $settingAppService;
    }

    /**
     * @return AnonymousResourceCollection|JsonResponse
     */
    public function all(): AnonymousResourceCollection|JsonResponse
    {
        try {
            $data = $this->settingAppRepository->findAll();

            return SettingAppResource::collection($data);
        } catch (Exception $e) {
            return $this->errorResponse($e);
        }
    }

    /**
     * @param int $id
     * @return SettingAppResource|JsonResponse
     */
    public function find(int $id): SettingAppResource|JsonResponse
    {
        try {
            $item = $this->settingAppRepository->find($id);

            return new SettingAppResource($item);
        } catch (Exception $e) {
            return $this->errorResponse($e);
        }
    }

    /**
     * @param SettingAppRequest $request
     * @param int $id
     * @return JsonResponse
     */
    public function update(SettingAppRequest $request, int $id): JsonResponse
    {
        try {
            $item = $this->settingAppRepository->find($id);
            $this->settingAppService->update($request->all(), $item);

            return $this->createdResponse();
        } catch (Exception $e) {
            return $this->errorResponse($e);
        }
    }
}
