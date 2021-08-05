<?php

namespace App\Services\Payments;

use App\Models\Payments\PromotionalCode;
use App\Repositories\Payments\PromotionalCodeRepository;
use App\Services\Service;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use JetBrains\PhpStorm\Pure;

class PromotionalCodeService extends Service
{
    /**
     * @param PromotionalCode $model
     * @param PromotionalCodeRepository $promotionalCodeRepository
     */
    #[Pure] public function __construct(
        PromotionalCode $model,
        private PromotionalCodeRepository $promotionalCodeRepository
    )
    {
        parent::__construct($model);
    }

    /**
     * @param array $data
     * @return Model
     */
    public function save(array $data): Model
    {
        $data['name'] = strtoupper(Str::random(5));

        return parent::save($data);
    }
}
