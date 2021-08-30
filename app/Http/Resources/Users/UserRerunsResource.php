<?php

namespace App\Http\Resources\Users;

use App\Http\Resources\Courses\CourseLessonExerciseResource;
use Illuminate\Http\Resources\Json\JsonResource;
use \Illuminate\Http\Request;

class UserRerunsResource extends JsonResource
{
    /**
     * @param Request $request
     * @return array
     */
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'created_at' => (string)$this->created_at,
            'user' => new UserResource($this->user),
            'exercise' => new CourseLessonExerciseResource($this->exercise)
        ];
    }
}
