<?php

namespace App\Models\Courses\Exercises;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @package App\Models\Courses\Exercises
 * @property int exercise_id
 * @property string txt
 */
class ExerciseIndicateCorrectAnswer extends Model
{
    use HasFactory;

    /**
     * @var string $table
     */
    protected $table = 'exercise_indicate_correct_answers';

    /**
     * @var string[] $fillable
     */
    protected $fillable = [
        'exercise_id',
        'txt'
    ];

    /**
     * @return BelongsTo
     */
    public function exercise(): BelongsTo
    {
        return $this->belongsTo(Exercise::class);
    }

    /**
     * @return HasMany
     */
    public function answers(): HasMany
    {
        return $this->hasMany(ExerciseListenAnswerQuestionAnswer::class, 'question_id')
            ->where('exercise_id', $this->exercise_id);
    }
}
