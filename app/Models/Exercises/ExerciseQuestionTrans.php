<?php

namespace App\Models\Exercises;

use App\Models\Courses\Exercises\Exercise;
use App\Models\Courses\Exercises\ExerciseListenAnswerQuestionAnswer;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ExerciseQuestionTrans extends Model
{
    use HasFactory;

    /**
     * @var string $table
     */
    protected $table = 'exercise_question_trans';

    /**
     * @var string[] $fillable
     */
    protected $fillable = [
        'exercise_id',
        'question',
        'question_trans'
    ];

    /**
     * @return BelongsTo
     */
    public function exercise(): BelongsTo
    {
        return $this->belongsTo(Exercise::class)->withDefault();
    }

    /**
     * @return HasMany
     */
    public function answers(): HasMany
    {
        return $this->hasMany(ExerciseListenAnswerQuestionAnswer::class, 'question_id');
    }
}
