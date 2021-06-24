<?php

namespace App\Services\Courses;

use App\Models\Courses\Course;
use App\Services\Service;
use Illuminate\Database\Eloquent\Model;
use JetBrains\PhpStorm\Pure;

class CourseService extends Service
{
    /**
     * @var Model $model
     */
    protected Model $model;

    /**
     * @param Course $model
     */
    #[Pure] public function __construct(Course $model)
    {
        parent::__construct($model);
    }
}
