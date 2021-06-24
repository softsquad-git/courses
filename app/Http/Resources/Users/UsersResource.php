<?php

namespace App\Http\Resources\Users;

use Illuminate\Http\Resources\Json\JsonResource;
use \Illuminate\Http\Request;

class UsersResource extends JsonResource
{
    /**
     * @param Request $request
     * @return array
     */
    public function toArray($request): array
    {
        return [
            'name' => $this->name,
            'avatar' => $this->avatarImage,
            'status' => [
                'code' => $this->is_active,
                'name' => $this->is_active ? 'Tak' : 'Nie'
            ],
            'created_at' => (string)$this->created_at
        ];
    }
}
