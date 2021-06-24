<?php

namespace App\Http\Controllers\Admin\Languages;

use App\Http\Controllers\ApiController;
use App\Http\Requests\Languages\LanguageRequest;
use App\Http\Resources\Lenguages\LanguageResource;
use App\Repositories\Languages\LanguageRepository;
use App\Services\Languages\LanguageService;
use \Exception;
use Illuminate\Http\JsonResponse;
use \Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class LanguageController extends ApiController
{
    /**
     * @var LanguageRepository $languageRepository
     */
    private LanguageRepository $languageRepository;

    /**
     * @var LanguageService $languageService
     */
    private LanguageService $languageService;

    /**
     * @param LanguageService $languageService
     * @param LanguageRepository $languageRepository
     */
    public function __construct(
        LanguageService $languageService,
        LanguageRepository $languageRepository
    )
    {
        $this->languageRepository = $languageRepository;
        $this->languageService = $languageService;
    }

    /**
     * @return JsonResponse|AnonymousResourceCollection
     */
    public function all(): JsonResponse|AnonymousResourceCollection
    {
        try {
            $data = $this->languageRepository->findAll();

            return LanguageResource::collection($data);
        } catch (Exception $e) {
            return $this->errorResponse($e);
        }
    }

    /**
     * @param int $id
     * @return LanguageResource|JsonResponse
     */
    public function find(int $id): LanguageResource|JsonResponse
    {
        try {
            $item = $this->languageRepository->find($id);

            return new LanguageResource($item);
        } catch (Exception $e) {
            return $this->errorResponse($e);
        }
    }

    /**
     * @param LanguageRequest $request
     * @return JsonResponse
     */
    public function create(LanguageRequest $request): JsonResponse
    {
        try {
            $this->languageService->save($request->all());

            return $this->createdResponse();
        } catch (Exception $e) {
            return $this->errorResponse($e);
        }
    }

    /**
     * @param LanguageRequest $request
     * @param int $id
     * @return JsonResponse
     */
    public function update(LanguageRequest $request, int $id): JsonResponse
    {
        try {
            $item = $this->languageRepository->find($id);
            $this->languageService->update($request->all(), $item);

            return $this->createdResponse();
        } catch (Exception $e) {
            return $this->errorResponse($e);
        }
    }

    /**
     * @param int $id
     * @return JsonResponse
     */
    public function remove(int $id): JsonResponse
    {
        try {
            $item = $this->languageRepository->find($id);
            $this->languageService->remove($item);

            return $this->deletedResponse();
        } catch (Exception $e) {
            return $this->errorResponse($e);
        }
    }
}
