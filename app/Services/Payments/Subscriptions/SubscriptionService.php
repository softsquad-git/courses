<?php

namespace App\Services\Payments\Subscriptions;

use App\Helpers\Price;
use App\Models\Subscriptions\Subscription;
use App\Services\Service;
use Illuminate\Database\Eloquent\Model;
use JetBrains\PhpStorm\Pure;
use Exception;

class SubscriptionService extends Service
{
    /**
     * @param Subscription $model
     */
    #[Pure] public function __construct(Subscription $model)
    {
        parent::__construct($model);
    }

    /**
     * @param array $data
     * @return Model
     * @throws Exception
     */
    public function save(array $data): Model
    {
        $data['price'] = Price::code($data['price']);
        $data['price_promo'] = Price::code($data['price_promo']);
        $data['on_period'] = Price::code($data['on_period']);
        return parent::save($data);
    }

    public function update(array $data, Model $model): Model
    {
        $data['price'] = Price::code($data['price']);
        $data['price_promo'] = Price::code($data['price_promo']);
        $data['on_period'] = Price::code($data['on_period']);
        return parent::update($data, $model);
    }

}
