<?php

namespace App\Services\Home;

use App\Models\Home\HomeWord;
use App\Services\Service;
use JetBrains\PhpStorm\Pure;

class HomeWordService extends Service
{
    /**
     * @param HomeWord $model
     */
    #[Pure] public function __construct(HomeWord $model)
    {
        parent::__construct($model);
    }
}
