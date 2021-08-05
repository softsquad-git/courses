<?php

namespace App\Repositories\Payments\Subscriptions;

use App\Models\Subscriptions\Subscription;
use App\Repositories\Repository;
use Illuminate\Database\Eloquent\Model;

class SubscriptionRepository extends Repository
{
    /**
     * @var Model $model
     */
    protected Model $model;

    /**
     * @param Subscription $subscription
     */
    public function __construct(Subscription $subscription)
    {
        $this->model = $subscription;
    }

}
