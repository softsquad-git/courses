<?php

namespace App\Http\Resources\Courses;

use Illuminate\Http\Resources\Json\JsonResource;

class CourseLessonExerciseMatchPairsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'txt' => $this->txt,
            'txt_trans' => $this->txt_trans
        ];
    }
}
