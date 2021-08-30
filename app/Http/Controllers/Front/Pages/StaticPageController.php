<?php

namespace App\Http\Controllers\Front\Pages;

use App\Http\Controllers\ApiController;
use App\Http\Controllers\Controller;
use App\Http\Resources\Pages\StaticPageResource;
use App\Models\Pages\StaticPage;
use App\Repositories\Pages\StaticPageRepository;
use \Illuminate\Http\JsonResponse;

class StaticPageController extends ApiController
{
    /**
     * @param StaticPageRepository $staticPageRepository
     */
    public function __construct(
        private StaticPageRepository $staticPageRepository
    )
    {
    }

    /**
     * @param string $name
     * @return StaticPageResource|JsonResponse
     */
    public function findByPage(string $name): StaticPageResource|JsonResponse
    {
        /**
         * @var StaticPage $page
         */
        $page = $this->staticPageRepository->findOneBy([
            'name' => $name
        ]);

        if (!$page) {
            return $this->noFoundResponse();
        }

        return new StaticPageResource($page);
    }
}
