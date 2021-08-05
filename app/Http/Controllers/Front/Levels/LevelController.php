<?php

namespace App\Http\Controllers\Front\Levels;

use App\Http\Controllers\ApiController;
use App\Http\Resources\Levels\LevelResource;
use App\Repositories\Levels\LevelRepository;
use \Exception;
use \Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\JsonResponse;

class LevelController extends ApiController
{
    /**
     * @param LevelRepository $levelRepository
     */
    public function __construct(
        private LevelRepository $levelRepository
    )
    {}

    /**
     * @return JsonResponse|AnonymousResourceCollection
     */
    public function __invoke(): JsonResponse|AnonymousResourceCollection
    {
        try {
            $data = $this->levelRepository->findAll();

            return LevelResource::collection($data);
        } catch (Exception $e) {
            return $this->errorResponse($e);
        }
    }
}
