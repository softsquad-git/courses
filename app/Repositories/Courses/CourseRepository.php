<?php

namespace App\Repositories\Courses;

use App\Models\Courses\Course;
use App\Repositories\Repository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;

class CourseRepository extends Repository
{
    /**
     * @var Model $model
     */
    protected Model $model;

    /**
     * @param Course $course
     */
    public function __construct(Course $course)
    {
        $this->model = $course;
    }

    /**
     * @param array $filters
     * @param string $ordering
     * @param int $pagination
     * @param int $limit
     * @return LengthAwarePaginator|Collection|array
     */
    public function findBy(
        array $filters,
        string $ordering = 'DESC',
        int $pagination = 20,
        int $limit = 0
    ): LengthAwarePaginator|Collection|array
    {
        $data = $this->model->orderBy('id', $ordering);

        if (isset($filters['language_id']) && !empty($filters['language_id']))
            $data->where(['language_id' => $filters['language_id']]);

        if (isset($filters['level_id']) && !empty($filters['level_id']))
            $data->where(['level_id' => $filters['level_id']]);

        if ($limit > 0)
            return $data->limit($limit)->get();

        return $data->paginate($pagination);
    }
}
