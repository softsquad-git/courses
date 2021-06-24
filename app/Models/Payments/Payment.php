<?php

namespace App\Models\Payments;

use App\Models\Courses\Course;
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

    protected $table = 'payments';

    protected $fillable = [
        'user_id',
        'amount',
        'is_invoice',
        'company_name',
        'company_address',
        'nip',
        'course_id',
        'token',
        'status'
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
    #[ArrayShape(['code' => "string", 'name' => "string"])] public function getStatusAttribute(): array
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
     * @return BelongsTo
     */
    public function course(): BelongsTo
    {
        return $this->belongsTo(Course::class)->withDefault();
    }
}
