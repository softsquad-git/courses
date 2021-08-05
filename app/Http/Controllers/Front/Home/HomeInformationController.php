<?php

namespace App\Http\Controllers\Front\Home;

use App\Http\Controllers\ApiController;
use App\Http\Resources\Home\HomeInformationResource;
use App\Repositories\Home\HomeInformationRepository;
use \Exception;
use \Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use \Illuminate\Http\JsonResponse;

class HomeInformationController extends ApiController
{
    /**
     * @param HomeInformationRepository $homeInformationRepository
     */
    public function __construct(
        private HomeInformationRepository $homeInformationRepository
    )
    {
    }

    /**
     * @return JsonResponse|AnonymousResourceCollection
     */
    public function __invoke(): JsonResponse|AnonymousResourceCollection
    {
        try {
            $data = $this->homeInformationRepository->findAll();

            return HomeInformationResource::collection($data);
        } catch (Exception $e) {
            return $this->errorResponse($e);
        }
    }
}
