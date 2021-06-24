<?php

namespace App\Services\Levels;

use App\Models\Courses\Level;
use App\Services\Service;
use Illuminate\Database\Eloquent\Model;
use JetBrains\PhpStorm\Pure;

class LevelService extends Service
{
    /**
     * @var Model $model
     */
    protected Model $model;

    /**
     * @param Level $model
     */
    #[Pure] public function __construct(Level $model)
    {
        parent::__construct($model);
    }
}
