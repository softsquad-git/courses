<?php

namespace App\Models\Payments;

use App\Models\Courses\Course;
use App\Models\Subscriptions\Subscription;
use App\Models\Users\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use JetBrains\PhpStorm\ArrayShape;

/**
 * @package App\Models\Payments
 * @property int user_id
 * @property int amount
 * @property bool is_invoice
 * @property string|null company_name
 * @property string|null company_address
 * @property string|null nip
 * @property int course_id
 * @property string token
 * @property string status
 * @property array status_value
 * @property User user
 * @property int subscribe_id
 * @method static create(array $data)
 */
class Payment extends Model
{
    use HasFactory;

    /**
     * @var array|int[] $statuses
     */
    public static array $statuses = [
        'STARTED' => 1,
        'CANCELED' => 2,
        'FINISHED' => 3
    ];

    /**
     * @var string $table
     */
    protected $table = 'payments';

    /**
     * @var string[] $fillable
     */
    protected $fillable = [
        'user_id',
        'amount',
        'is_invoice',
        'company_name',
        'company_address',
        'nip',
        'token',
        'status',
        'payu_order_id',
        'subscribe_id'
    ];

    /**
     * @var string[] $appends
     */
    protected $appends = [
        'status_value'
    ];

    /**
     * @return array
     */
    #[ArrayShape(['code' => "string", 'name' => "string"])] public function getStatusValueAttribute(): array
    {
        return [
            'code' => $this->status,
            'name' => __('status.'.$this->status)
        ];
    }

    /**
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class)->withDefault();
    }

    /**
     * @return float|int|null
     */
    public function getAmount(): float|int|null
    {
        return $this->amount / 100;
    }

    /**
     * @return BelongsTo
     */
    public function subscribe(): BelongsTo
    {
        return $this->belongsTo(Subscription::class)->withDefault();
    }

}
