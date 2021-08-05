<?php

namespace App\Http\Controllers\Front\Payments;

use App\Http\Controllers\ApiController;
use App\Http\Resources\Payments\SubscriptionsResource;
use App\Repositories\Payments\Subscriptions\SubscriptionRepository;
use \Exception;
use \Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use \Illuminate\Http\JsonResponse;

class SubscriptionController extends ApiController
{
    /**
     * @param SubscriptionRepository $subscriptionRepository
     */
    public function __construct(
        private SubscriptionRepository $subscriptionRepository
    )
    {
    }

    /**
     * @return JsonResponse|AnonymousResourceCollection
     */
    public function __invoke(): JsonResponse|AnonymousResourceCollection
    {
        try {
            $data = $this->subscriptionRepository->findAll();

            return SubscriptionsResource::collection($data);
        } catch (Exception $e) {
            return $this->errorResponse($e);
        }
    }
}
