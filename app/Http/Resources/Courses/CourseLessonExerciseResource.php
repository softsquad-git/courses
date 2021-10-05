<?php

namespace App\Http\Resources\Courses;

use App\Models\Courses\Exercises\Exercise;
use App\Models\Users\UserLessonExerciseProgress;
use Illuminate\Http\Resources\Json\JsonResource;
use \Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CourseLessonExerciseResource extends JsonResource
{
    /**
     * @param Request $request
     * @return array
     */
    public function toArray($request): array
    {
        $completed = UserLessonExerciseProgress::where([
            'lesson_id' => $this->lesson_id,
            'user_id' => Auth::id()
        ])->get();

        return [
            'id' => $this->id,
            'lesson' => $this->lesson_id,
            'type' => $this->type,
            'position' => $this->position,
            'template' => $this->template($this->type, $this->template),
            'speech_bubble_top' => $this->lesson?->speech_bubble,
            'speech_bubble_bottom' => $this->speech_bubble_bottom,
            'progress' => [
                'completed' => $completed->count(),
                'all' => $this->lesson->exercises->count()
            ]
        ];
    }


    private function template(int $type, object $template)
    {
        if ($type == Exercise::$types['DIALOGUE']) {
            return new CourseDialogueResource($template);
        }

        if ($type == Exercise::$types['MATCH_WORDS_PAIRS']) {
            return [
                'header' => $this->header,
                'words' => CourseLessonExerciseMatchPairsResource::collection($this->template)
            ];
        }

        return new CourseLessonExercisesTemplateResource($template);
    }
}
