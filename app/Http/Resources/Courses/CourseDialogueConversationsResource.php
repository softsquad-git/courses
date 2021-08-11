<?php

namespace App\Http\Resources\Courses;

use App\Models\Courses\Exercises\Dialogue\Dialogue;
use Illuminate\Http\Resources\Json\JsonResource;
use \Illuminate\Http\Request;

class CourseDialogueConversationsResource extends JsonResource
{
    /**
     * @param Request $request
     * @return array
     */
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'image' => $this->dialogue?->type == Dialogue::$types['interlocutor_one'] ? $this->dialogue?->getOneImage() : $this->dialogue?->getTwoImage(),
            'txt' => $this->txt,
            'txt_trans' => $this->txt_trans,
            'type' => $this->type
        ];
    }
}
