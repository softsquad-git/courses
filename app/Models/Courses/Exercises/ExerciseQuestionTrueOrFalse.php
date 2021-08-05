<?php

namespace App\Models\Courses\Exercises;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ExerciseQuestionTrueOrFalse extends Model
{
    use HasFactory;

    /**
     * @var string $table
     */
    protected $table = 'exercise_question_true_or_false';

    /**
     * @var string[] $fillable
     */
    protected $fillable = [
        'exercise_id',
        'question',
        'is_true'
    ];

    /**
     * @return BelongsTo
     */
    public function exercise(): BelongsTo
    {
        return $this->belongsTo(Exercise::class)->withDefault();
    }
}
