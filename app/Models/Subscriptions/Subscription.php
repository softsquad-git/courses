<?php

namespace App\Models\Subscriptions;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @package App\Models\Subscriptions
 * @property string name
 * @property int price
 * @property int price_promo
 * @property string unit
 * @property int id
 * @property bool is_best_offer
 */
class  Subscription extends Model
{
    use HasFactory;

    /**
     * @var string $table
     */
    protected $table = 'subscriptions';

    /**
     * @var string[] $fillable
     */
    protected $fillable = [
        'name',
        'price',
        'price_promo',
        'unit',
        'is_best_offer'
    ];

    /**
     * @return float|int|null
     */
    public function getPrice(): float|int|null
    {
        if ($this->price) {
            return $this->price / 100;
        }

        return null;
    }

    /**
     * @return float|int|null
     */
    public function getPricePromo(): float|int|null
    {
        if ($this->price_promo) {
            return $this->price_promo / 100;
        }

        return null;
    }
}
