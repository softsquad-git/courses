<?php

namespace App\Repositories\Courses;

use App\Models\Courses\Exercises\Exercise;
use App\Models\Courses\Lesson;
use App\Repositories\Repository;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;

class CourseLessonRepository extends Repository
{
    /**
     * @var Model $model
     */
    protected Model $model;

    /**
     * @param Lesson $lesson
     */
    public function __construct(Lesson $lesson)
    {
        $this->model = $lesson;
    }

    /**
     * @param array $filters
     * @return LengthAwarePaginator
     */
    public function findBy(array $filters): LengthAwarePaginator
    {
        $data = $this->model::orderBy('id', 'DESC');

        if (isset($filters['course_id']) && !empty($filters['course_id']))
            $data->where(['course_id' => $filters['course_id']]);

        return $data->paginate(20);
    }
}
