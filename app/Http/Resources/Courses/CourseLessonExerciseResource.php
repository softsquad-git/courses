<?php

namespace App\Http\Resources\Courses;

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
            'template' => new CourseLessonExercisesTemplateResource($this->template),
            'speechBobble' => new CourseExerciseSpeechBubbleResource($this->speechBooble)
        ];
    }
}
