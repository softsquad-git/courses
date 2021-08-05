<?php

namespace App\Services\Payments\Subscriptions;

use App\Helpers\Price;
use App\Models\Subscriptions\Subscription;
use App\Services\Service;
use Illuminate\Database\Eloquent\Model;
use JetBrains\PhpStorm\Pure;

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
     */
    public function save(array $data): Model
    {
        $data['price'] = Price::code($data['price']);
        return parent::save($data);
    }

}
