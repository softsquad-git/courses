<?php

namespace App\Http\Resources\Courses;

use App\Models\Courses\Lesson;
use App\Models\Users\UserAudio;
use App\Models\Users\UserLessonExerciseProgress;
use Illuminate\Http\Resources\Json\JsonResource;
use \Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use JetBrains\PhpStorm\Pure;

/**
 * @package App\Http\Resources\Courses
 */
class CourseLessonResource extends JsonResource
{
    /**
     * @param Request $request
     * @return array
     */
    public function toArray($request): array
    {
        $completed = UserLessonExerciseProgress::where([
            'lesson_id' => $this->id,
            'user_id' => Auth::id()
        ])->get();

        return [
            'id' => $this->id,
            'name' => $this->name,
            'image' => asset(Lesson::$fileDir.$this->image),
            'course' => new CourseResource($this->course),
            'created_at' => (string)$this->created_at,
            'description' => $this->description,
            'position' => $this->position,
            'time' => $this->lesson_time.' min',
            'progress' => [
                'completed' => $completed->count(),
                'all' => $this->exercises->count(),
                'percent' => $this->getPercentage($this->exercises->count(), $completed->count())
            ],
            'is_premium' => Auth::user()->is_premium ? 0 : $this->is_premium,
            'countFlashcards' => $this->flashcards->count(),
            'file_audio' => $this->getAudio(),
            'time_file_audio' => $this->time_file_audio.' min',
            'file_audio_src' => $this->file_audio,
            'is_added_audio' => UserAudio::where(['lesson_id' => $this->id, 'user_id' => Auth::id()])->first() ? true : false
        ];
    }

    #[Pure] private function getPercentage($total, $number): float|int
    {
        if ( $total > 0 ) {
            return round(($number * 100) / $total, 2);
        } else {
            return 0;
        }
    }
}
