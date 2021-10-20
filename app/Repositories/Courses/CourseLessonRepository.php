<?php

namespace App\Repositories\Courses;

use App\Models\Courses\Exercises\Exercise;
use App\Models\Courses\Lesson;
use App\Models\Users\UserLessonExerciseProgress;
use App\Repositories\Repository;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;
use JetBrains\PhpStorm\ArrayShape;

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

    /**
     * @param int $courseId
     * @return array
     */
    #[ArrayShape(['completeLesson' => "int", 'completeLessonPercent' => "string"])] public function completeLessonStat(int $courseId): array
    {
        $lessons = Lesson::where('course_id', $courseId)->get();

        $lessonCompleteIds = [];

        foreach ($lessons as $lesson) {
            $lessonExerciseCount = $lesson->exercises()->count();
            $exerciseCompleteCount = UserLessonExerciseProgress::where(['lesson_id' => $lesson->id])->count();
            if ($lessonExerciseCount > 0 && $exerciseCompleteCount >= $lessonExerciseCount) {
                $lessonCompleteIds[] = $lesson->id;
            }
        }

        return [
            'completeLesson' => count($lessonCompleteIds),
            'completeLessonPercent' => intval((count($lessonCompleteIds) * 100) / $lessons->count())
        ];
    }
}
