<?php

namespace App\Repositories\Courses;

use App\Models\Courses\Exercises\Exercise;
use App\Repositories\Repository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;

class CourseLessonExerciseRepository extends Repository
{
    protected Model $model;

    /**
     * @param Exercise $exercise
     */
    public function __construct(Exercise $exercise)
    {
        $this->model = $exercise;
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
        int $pagination = 30,
        int $limit = 0
    ): LengthAwarePaginator|Collection|array
    {
        $data = $this->model::orderBy('position', $ordering);

        if (isset($filters['lesson_id']) && !empty($filters['lesson_id'])) {
            $data->where([
                'lesson_id' => $filters['lesson_id']
            ]);
        }

        if ($limit > 0) {
            return $data->limi($limit)->get();
        }

        return $data->paginate($pagination);
    }

    /**
     * @param int $lessonId
     * @return int|null
     */
    public function getMaxPosition(int $lessonId): ?int
    {
        $lessons = Exercise::where(['lesson_id' => $lessonId])->get();
        if ($lessons->count() == 0) {
            return null;
        }

        return $lessons->max('position');
    }

    /**
     * @param int $lessonId
     * @param int $position
     * @param int|null $type
     * @return Exercise|null
     */
    public function findExercise(int $lessonId, int $position, int $type = null): Exercise|null
    {
        $item = Exercise::where([
            'lesson_id' => $lessonId,
            'position' => $position
        ]);

        if ($type) {
            $item->where(['type' => $type]);
        }

        return $item->first();
    }

    /**
     * @param int $id
     * @param int $type
     * @return Exercise|null
     */
    public function next(int $id, int $type): Exercise|null
    {
        return Exercise::where('id', '>', $id)
            ->where('type', $type)
            ->first();
    }
}
