<?php

namespace App\Http\Resources\Courses;

use Illuminate\Http\Resources\Json\JsonResource;
use \Illuminate\Http\Request;

class CourseLessonExercisesTemplateResource extends JsonResource
{
    /**
     * @param Request $request
     * @return array
     */
    public function toArray($request): array
    {
        $data = parent::toArray($request);


        if ($this->image) {
            $data['image'] = $this->getImage();
        }

        if ($this->sound_file) {
            $data['sound_file'] = $this->getSoundFile();
        }

        if ($this->answers) {
            $data['answers'] = CourseExerciseAnswersResource::collection($this->answers);
        }


        return $data;
    }
}
