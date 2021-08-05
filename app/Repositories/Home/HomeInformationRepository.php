<?php

namespace App\Repositories\Home;

use App\Models\Home\HomeInfo;
use App\Repositories\Repository;

class HomeInformationRepository extends Repository
{
    /**
     * @param HomeInfo $homeInfo
     */
    public function __construct(HomeInfo $homeInfo)
    {
        $this->model = $homeInfo;
    }
}
