<?php

namespace App\Http\Resources\Payments;

use App\Helpers\Price;
use Illuminate\Http\Resources\Json\JsonResource;
use \Illuminate\Http\Request;

class SubscriptionsResource extends JsonResource
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
            'price' => Price::decode($this->price),
            'price_promo' => Price::decode($this->price_promo),
            'unit' => $this->unit
        ];
    }
}
