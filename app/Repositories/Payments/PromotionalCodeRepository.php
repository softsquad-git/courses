<?php

namespace App\Repositories\Payments;

use App\Models\Payments\PromotionalCode;
use App\Repositories\Repository;
use Illuminate\Database\Eloquent\Model;

class PromotionalCodeRepository extends Repository
{
    /**
     * @var Model $model
     */
    protected Model $model;

    /**
     * PromotionalCodeRepository constructor.
     * @param PromotionalCode $model
     */
    public function __construct(PromotionalCode $model)
    {
        $this->model = $model;
    }
}
