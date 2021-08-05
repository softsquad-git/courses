<?php

namespace App\Models\Payments;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @package App\Models\Payments
 * @property string name
 * @property string start_time
 * @property string end_time
 * @property int percent_minus
 */
class PromotionalCode extends Model
{
    use HasFactory;

    /**
     * @var string $table
     */
    protected $table = 'promotional_codes';

    /**
     * @var string[] $fillable
     */
    protected $fillable = [
        'name',
        'start_time',
        'end_time',
        'percent_minus'
    ];
}
