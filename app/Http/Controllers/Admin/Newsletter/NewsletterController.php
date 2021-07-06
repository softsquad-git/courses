<?php

namespace App\Http\Controllers\Admin\Newsletter;

use App\Http\Controllers\ApiController;
use App\Http\Resources\Newsletter\NewsletterResource;
use App\Repositories\Newsletter\NewsletterRepository;
use App\Services\Newsletter\NewsletterService;
use \Exception;
use Illuminate\Http\JsonResponse;
use \Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class NewsletterController extends ApiController
{
    /**
     * @param NewsletterRepository $newsletterRepository
     * @param NewsletterService $newsletterService
     */
    public function __construct(
        private NewsletterRepository $newsletterRepository,
        private NewsletterService $newsletterService
    )
    {}

    /**
     * @return JsonResponse|AnonymousResourceCollection
     */
    public function all(): JsonResponse|AnonymousResourceCollection
    {
        try {
            $data = $this->newsletterRepository->findAll();

            return NewsletterResource::collection($data);
        } catch (Exception $e) {
            return $this->errorResponse($e);
        }
    }
}
