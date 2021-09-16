<?php

namespace App\Http\Resources\Courses;

use Illuminate\Http\Resources\Json\JsonResource;
use \Illuminate\Http\Request;

class CourseDialogueResource extends JsonResource
{
    /**
     * @param Request $request
     * @return array
     */
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'one_image' => $this->getOneImage(),
            'two_image' => $this->getTwoImage(),
            'sound_file' => $this->getSoundFile(),
            'conversations' => CourseDialogueConversationsResource::collection($this->conversations),
            'header' => $this->exercise?->header
        ];
    }
}
