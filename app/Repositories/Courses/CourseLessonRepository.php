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
        $data = $this->model::orderBy('position', 'ASC');

        if (isset($filters['course_id']) && !empty($filters['course_id']))
            $data->where(['course_id' => $filters['course_id']]);

        if (isset($filters['name']) && !empty($filters['name'])) {
            $data->where('name', 'like', '%' . $filters['name'] . '%');
        }

        if (isset($filters['level_id']) && !empty($filters['level_id'])) {
            $data->whereHas('course', function ($course) use ($filters) {
                $course->where('level_id', $filters['level_id']);
            });
        }

        return $data->paginate($this->pagination);
    }

    /**
     * @param int $lessonId
     * @param int $courseId
     * @return Lesson|null
     */
    public function findNextLesson(int $lessonId, int $courseId): Lesson|null
    {
        return Lesson::where('id', '>', $lessonId)
            ->where('course_id', $courseId)
            ->first();
    }
}
