<?php

namespace App\Services\Pages;

use App\Models\Pages\StaticPage;
use App\Services\Service;
use JetBrains\PhpStorm\Pure;

class StaticPageService extends Service
{
    #[Pure] public function __construct(StaticPage $model)
    {
        parent::__construct($model);
    }
}
