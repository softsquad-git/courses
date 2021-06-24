<?php

namespace App\Http\Resources\Courses;

use Illuminate\Http\Resources\Json\JsonResource;
use \Illuminate\Http\Request;

class CoursesResource extends JsonResource
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
            'status' => [
                'code' => $this->is_active,
                'name' => $this->is_active ? 'Tak' : 'Nie'
            ],
            'level' => [
                'id' => $this->level_id,
                'name' => $this->level->name
            ],
            'created_at' => (string)$this->created_at
        ];
    }
}
