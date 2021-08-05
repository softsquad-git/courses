<?php

namespace App\Models\Courses\Exercises;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ExerciseTip extends Model
{
    use HasFactory;

    /**
     * @var array|string[] $types
     */
    public static array $types = [
        'top' => 'top',
        'bottom' => 'bottom'
    ];

    /**
     * @var string $table
     */
    protected $table = 'exercise_tips';

    /**
     * @var string[] $fillable
     */
    protected $fillable = [
        'exercise_id',
        'content'
    ];

    /**
     * @return BelongsTo
     */
    public function exercise(): BelongsTo
    {
        return $this->belongsTo(Exercise::class)->withDefault();
    }
}
