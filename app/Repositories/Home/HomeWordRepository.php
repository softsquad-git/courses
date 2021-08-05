<?php

namespace App\Repositories\Home;

use App\Models\Home\HomeWord;
use App\Repositories\Repository;

class HomeWordRepository extends Repository
{
    /**
     * @param HomeWord $homeWord
     */
    public function __construct(HomeWord $homeWord)
    {
        $this->model = $homeWord;
    }
}
