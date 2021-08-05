<?php

namespace App\Http\Controllers\Front\Home;

use App\Http\Controllers\ApiController;
use App\Http\Resources\Home\HomeImagesResource;
use App\Repositories\Home\HomeImagesRepository;
use \Exception;
use \Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\JsonResponse;

class HomeImagesController extends ApiController
{
    /**
     * @param HomeImagesRepository $homeImagesRepository
     */
    public function __construct(
        private HomeImagesRepository $homeImagesRepository
    )
    {
    }

    /**
     * @return JsonResponse|AnonymousResourceCollection
     */
    public function __invoke(): JsonResponse|AnonymousResourceCollection
    {
        try {
            $data = $this->homeImagesRepository->findAll();

            return HomeImagesResource::collection($data);
        } catch (Exception $e) {
            return $this->errorResponse($e);
        }
    }
}
