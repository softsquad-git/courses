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
 * @property int id
 * @property int user_id
 * @property int amount
 * @property int subscribe_id
 * @property string payment_type
 * @property bool is_invoice
 * @property string|null company_name
 * @property string|null nip
 * @property string|null company_address
 * @property string|null payu_id
 * @property string|null paypal_id
 * @property int status
 * @property int token
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
        'PAID' => 2,
        'CANCEL' => 3,
        'PENDING' => 4
    ];
    /**
     * @var array|string[] $paymentTypes
     */
    public static array $paymentTypes = [
        'payu' => 'payu',
        'paypal' => 'paypal'
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
        'subscribe_id',
        'payment_type',
        'is_invoice',
        'company_name',
        'nip',
        'company_address',
        'payu_id',
        'paypal_id',
        'status',
        'token'
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
