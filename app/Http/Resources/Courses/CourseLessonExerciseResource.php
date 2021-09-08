<?php

namespace App\Http\Resources\Courses;

use App\Models\Courses\Exercises\Exercise;
use Illuminate\Http\Resources\Json\JsonResource;
use \Illuminate\Http\Request;

class CourseLessonExerciseResource extends JsonResource
{
    /**
     * @param Request $request
     * @return array
     */
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'lesson' => $this->lesson_id,
            'type' => $this->type,
            'position' => $this->position,
            'template' => $this->template($this->type, $this->template),
            'speech_bubble_top' => $this->speech_bubble_top,
            'speech_bubble_bottom' => $this->speech_bubble_bottom
        ];
    }


    private function template(int $type, object $template)
    {
        if ($type == Exercise::$types['DIALOGUE']) {
            return new CourseDialogueResource($template);
        }

        return new CourseLessonExercisesTemplateResource($template);
    }
}
