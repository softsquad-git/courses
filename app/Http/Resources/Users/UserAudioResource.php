<?php

namespace App\Http\Resources\Users;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Request;

class UserAudioResource extends JsonResource
{
    /**
     * @param Request $request
     * @return array
     */
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'lesson_id' => $this->lesson_id,
            'file' => $this->getFile(),
            'image' => $this->lesson?->getImage()
        ];
    }
}
