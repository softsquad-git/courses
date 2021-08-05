<?php

namespace App\Http\Controllers\Front\Home;

use App\Http\Controllers\ApiController;
use App\Http\Resources\Home\HomeWordsResource;
use App\Repositories\Home\HomeWordRepository;
use \Exception;
use \Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use \Illuminate\Http\JsonResponse;

class HomeWordsController extends ApiController
{
    /**
     * @param HomeWordRepository $homeWordRepository
     */
    public function __construct(
        private HomeWordRepository $homeWordRepository
    )
    {
    }

    /**
     * @return JsonResponse
     */
    public function __invoke(): JsonResponse
    {
        try {
            $data = $this->homeWordRepository->findAll();
            $items = [];
            foreach ($data as $item) {
                $items[] = $item->name;
            }
            return $this->successResponse('', $items);
        } catch (Exception $e) {
            return $this->errorResponse($e);
        }
    }
}
