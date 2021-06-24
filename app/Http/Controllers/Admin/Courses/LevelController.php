<?php

namespace App\Http\Controllers\Admin\Courses;

use App\Http\Controllers\ApiController;
use App\Http\Requests\Courses\LevelRequest;
use App\Http\Resources\Levels\LevelResource;
use App\Repositories\Levels\LevelRepository;
use App\Services\Levels\LevelService;
use \Exception;
use Illuminate\Http\JsonResponse;
use \Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class LevelController extends ApiController
{
    /**
     * @var LevelRepository $levelRepository
     */
    private LevelRepository $levelRepository;

    /**
     * @var LevelService $levelService
     */
    private LevelService $levelService;

    /**
     * @param LevelRepository $levelRepository
     * @param LevelService $levelService
     */
    public function __construct(
        LevelRepository $levelRepository,
        LevelService $levelService
    )
    {
        $this->levelRepository = $levelRepository;
        $this->levelService = $levelService;
    }

    /**
     * @param int $id
     * @return LevelResource|JsonResponse
     */
    public function find(int $id): LevelResource|JsonResponse
    {
        try {
            $item = $this->levelRepository->find($id);

            return new LevelResource($item);
        } catch (Exception $e) {
            return $this->errorResponse($e);
        }
    }

    /**
     * @return JsonResponse|AnonymousResourceCollection
     */
    public function all(): JsonResponse|AnonymousResourceCollection
    {
        try {
            $data = $this->levelRepository->findAll();

            return LevelResource::collection($data);
        } catch (Exception $e) {
            return $this->errorResponse($e);
        }
    }

    /**
     * @param LevelRequest $request
     * @return JsonResponse
     */
    public function create(LevelRequest $request): JsonResponse
    {
        try {
            $this->levelService->save($request->all());

            return $this->createdResponse();
        } catch (Exception $e) {
            return $this->errorResponse($e);
        }
    }

    /**
     * @param LevelRequest $request
     * @param int $id
     * @return JsonResponse
     */
    public function update(LevelRequest $request, int $id): JsonResponse
    {
        try {
            $item = $this->levelRepository->find($id);
            $this->levelService->update($request->all(), $item);

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
            $item = $this->levelRepository->find($id);
            $this->levelService->remove($item);

            return $this->deletedResponse();
        } catch (Exception $e) {
            return $this->errorResponse($e);
        }
    }
}
