<?php

namespace App\Http\Controllers\Front\Home;

use App\Http\Controllers\ApiController;
use App\Http\Resources\Testimonials\TestimonialResource;
use App\Repositories\Testimonials\TestimonialRepository;
use \Exception;
use \Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use \Illuminate\Http\JsonResponse;

class TestimonialsController extends ApiController
{
    /**
     * @param TestimonialRepository $testimonialRepository
     */
    public function __construct(
        private TestimonialRepository $testimonialRepository
    )
    {
    }

    /**
     * @return JsonResponse|AnonymousResourceCollection
     */
    public function all(): JsonResponse|AnonymousResourceCollection
    {
        try {
            $data = $this->testimonialRepository->findAll();

            return TestimonialResource::collection($data);
        } catch (Exception $e) {
            return $this->errorResponse($e);
        }
    }
}
