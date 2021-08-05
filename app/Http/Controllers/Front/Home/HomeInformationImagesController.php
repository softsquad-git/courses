<?php

namespace App\Http\Controllers\Front\Home;

use App\Http\Controllers\ApiController;
use App\Http\Resources\Home\HomeInformationImagesResource;
use App\Repositories\Home\HomeInformationImagesRepository;
use \Exception;
use \Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use \Illuminate\Http\JsonResponse;

class HomeInformationImagesController extends ApiController
{
    /**
     * @param HomeInformationImagesRepository $homeInformationImagesRepository
     */
    public function __construct(
        private HomeInformationImagesRepository $homeInformationImagesRepository
    )
    {
    }

    /**
     * @return JsonResponse|AnonymousResourceCollection
     */
    public function __invoke(): JsonResponse|AnonymousResourceCollection
    {
        try {
            $data = $this->homeInformationImagesRepository->findAll();

            return HomeInformationImagesResource::collection($data);
        } catch (Exception $e) {
            return $this->errorResponse($e);
        }
    }
}
