<?php

namespace App\Services\Newsletter;

use App\Models\Newsletter\Newsletter;
use App\Services\Service;
use JetBrains\PhpStorm\Pure;

class NewsletterService extends Service
{
    /**
     * @param Newsletter $model
     */
    #[Pure] public function __construct(Newsletter $model)
    {
        parent::__construct($model);
    }
}
