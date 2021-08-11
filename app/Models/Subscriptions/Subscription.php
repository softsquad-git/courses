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
        'unit'
    ];

    /**
     * @var array|string[] $units
     */
    public static array $units = [
        'day' => 'Dzień',
        'month' => 'Miesiąc',
        'year' => 'Rok'
    ];

    /**
     * @return Carbon|null
     */
    public function getExpiredAt(): ?Carbon
    {
        return match ($this->unit) {
            self::$units['day'] => Carbon::now()->addDay(),
            self::$units['month'] => Carbon::now()->addMonth(),
            self::$units['year'] => Carbon::now()->addYear(),
            default => null,
        };
    }
}
