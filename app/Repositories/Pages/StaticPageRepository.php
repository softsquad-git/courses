<?php

namespace App\Repositories\Pages;

use App\Models\Pages\StaticPage;
use App\Repositories\Repository;

class StaticPageRepository extends Repository
{
    /**
     * @param StaticPage $model
     */
    public function __construct(StaticPage $model)
    {
        $this->model = $model;
    }
}
