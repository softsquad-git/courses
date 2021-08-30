<?php

namespace App\Repositories\Courses;

use App\Models\Courses\Exercises\Exercise;
use App\Models\Courses\LessonFlashcard;
use App\Repositories\Repository;
use Illuminate\Pagination\LengthAwarePaginator;

class CourseLessonFlashcardsRepository extends Repository
{
    /**
     * @param LessonFlashcard $lessonFlashcard
     */
    public function __construct(LessonFlashcard $lessonFlashcard)
    {
        $this->model = $lessonFlashcard;
    }

    /**
     * @param array $filters
     * @return LengthAwarePaginator
     */
    public function findBy(array $filters): LengthAwarePaginator
    {
        $data = $this->model->orderBy('id', $this->ordering);

        if (isset($filters['lesson_id']) && !empty($filters['lesson_id'])) {
            $data->where([
                'lesson_id' => $filters['lesson_id']
            ]);
        }

        return $data->paginate($this->pagination);
    }

    /**
     * @param int $lessonId
     * @return Exercise|null
     */
    public function firstFlashcardByLesson(int $lessonId): Exercise|null
    {
        return Exercise::where([
            'lesson_id' => $lessonId,
            'type' => Exercise::$types['FLASHCARD']
        ])->first();
    }
}
