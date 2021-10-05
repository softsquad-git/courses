<?php

namespace App\Models\Courses\Exercises;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int id
 * @property int exercise_id
 * @property string txt
 * @property string txt_trans
 * @method static create(array $array)
 */
class ExercisePairs extends Model
{
    use HasFactory;

    /**
     * @var string $table
     */
    protected $table = 'exercise_pairs';

    /**
     * @var string[] $fillable
     */
    protected $fillable = [
        'exercise_id',
        'txt',
        'txt_trans'
    ];

    /**
     * @return BelongsTo
     */
    public function exercise(): BelongsTo
    {
        return $this->belongsTo(Exercise::class)->withDefault();
    }
}
