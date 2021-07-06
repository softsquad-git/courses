<?php

namespace App\Repositories\Newsletter;

use App\Models\Newsletter\Newsletter;
use App\Repositories\Repository;

class NewsletterRepository extends Repository
{
    /**
     * @param Newsletter $newsletter
     */
    public function __construct(Newsletter $newsletter)
    {
        $this->model = $newsletter;
    }
}
