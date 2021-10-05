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
        $onPeriodPartials = explode('.', $this->getOnPeriod());
        return [
            'id' => $this->id,
            'price' => $this->getPrice(),
            'price_promo' => $this->getPricePromo(),
            'on_period' => [
                'all' => $this->getOnPeriod(),
                'price' => $onPeriodPartials[0],
                'cents' => $onPeriodPartials[1]
            ],
            'period' => $this->period,
            'percent_minus' => $this->price_promo ? round(((($this->price - $this->price_promo) / $this->price) * 100), 0) : null
        ];
    }
}
