<?php


namespace App\Repositories\Levels;
use App\Models\Courses\Level;
use App\Repositories\Repository;
use Illuminate\Database\Eloquent\Model;

class LevelRepository extends Repository
{
    /**
     * @var Model $model
     */
    protected Model $model;

    /**
     * @param Level $level
     */
    public function __construct(Level $level)
    {
        $this->model = $level;
    }
}
