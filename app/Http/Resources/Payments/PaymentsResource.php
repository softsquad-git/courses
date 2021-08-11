<?php

namespace App\Http\Resources\Payments;

use Illuminate\Http\Resources\Json\JsonResource;
use \Illuminate\Http\Request;

class PaymentsResource extends JsonResource
{
    /**
     * @param Request $request
     * @return array
     */
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'amount' => $this->getAmount(),
            'expired' => $this->subscribe?->getExpiredAt(),
            'subscription' => $this->subscribe?->name,
            'status' => $this->status_value['name'],
            'status_code' => $this->status_value['code'],
        ];
    }
}
