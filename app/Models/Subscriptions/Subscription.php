<?php

namespace App\Models\Subscriptions;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @package App\Models\Subscriptions
 * @property string period
 * @property int price
 * @property int on_period
 * @property int|null price_promo
 * @property string|null footer_info
 * @property int id
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
        'period',
        'price',
        'price_promo',
        'on_period',
        'footer_info'
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

    /**
     * @return float|int|null
     */
    public function getOnPeriod(): float|int|null
    {
        if ($this->on_period) {
            return $this->on_period / 100;
        }

        return null;
    }
}
