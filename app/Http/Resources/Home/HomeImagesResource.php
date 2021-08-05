<?php

namespace App\Http\Resources\Home;

use Illuminate\Http\Resources\Json\JsonResource;
use \Illuminate\Http\Request;

class HomeImagesResource extends JsonResource
{
    /**
     * @param Request $request
     * @return array
     */
    public function toArray($request): array
    {
        return [
            'position' => $this->position,
            'image' => $this->getImage()
        ];
    }
}
