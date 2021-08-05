<?php

namespace App\Repositories\Home;

use App\Models\Home\HomeInfoImages;
use App\Repositories\Repository;

class HomeInformationImagesRepository extends Repository
{
    /**
     * @param HomeInfoImages $homeInfoImages
     */
    public function __construct(HomeInfoImages $homeInfoImages)
    {
        $this->model = $homeInfoImages;
    }
}
