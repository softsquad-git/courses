<?php

namespace App\Models\Users;

use App\Models\Courses\Exercises\Exercise;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @package App\Models\Users
 * @property int user_id
 * @property int exercise_id
 * @property User user
 * @property Exercise exercise
 * @property int id
 */
class UserRerun extends Model
{
    use HasFactory;

    /**
     * @var string $table
     */
    protected $table = 'user_reruns';

    /**
     * @var string[] $fillable
     */
    protected $fillable = [
        'user_id',
        'exercise_id'
    ];

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
    public function exercise(): BelongsTo
    {
        return $this->belongsTo(Exercise::class)->withDefault();
    }
}
