<?php

namespace App\Http\Resources\Courses;

use Illuminate\Http\Resources\Json\JsonResource;

class CourseExerciseAnswersResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return parent::toArray($request);
    }
}
