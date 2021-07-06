<?php

namespace App\Http\Resources\Courses;

use Illuminate\Http\Resources\Json\JsonResource;
use \Illuminate\Http\Request;

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
        return [
            'id' => $this->id,
            'name' => $this->name,
            'image' => $this->getImage(),
            'course' => new CourseResource($this->course),
            'created_at' => (string)$this->created_at,
            'description' => $this->description,
            'position' => $this->position
        ];
    }
}
