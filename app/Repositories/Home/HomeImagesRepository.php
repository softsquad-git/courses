<?php

namespace App\Repositories\Home;

use App\Models\Home\HomeImages;
use App\Repositories\Repository;

class HomeImagesRepository extends Repository
{
    /**
     * @param HomeImages $homeImages
     */
    public function __construct(HomeImages $homeImages)
    {
        $this->model = $homeImages;
    }
}
