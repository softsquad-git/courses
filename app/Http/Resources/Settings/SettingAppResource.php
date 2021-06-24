<?php

namespace App\Http\Resources\Settings;

use Illuminate\Http\Resources\Json\JsonResource;
use \Illuminate\Http\Request;

class SettingAppResource extends JsonResource
{
    /**
     * @param Request $request
     * @return array
     */
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'name' => [
                'trans' => $this->nameTrans,
                'code' => $this->name
            ],
            'type' => $this->type_rans,
            'value' => $this->value_item
        ];
    }
}
