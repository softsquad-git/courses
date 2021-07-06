<?php

namespace App\Models\Courses\Exercises;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @method static insert(array $dataSave)
 */
class ExerciseListenAnswerQuestionAnswer extends Model
{
    use HasFactory;

    /**
     * @var string $table
     */
    protected $table = 'exercise_listen_answer_question_answers';

    /**
     * @var string[] $fillable
     */
    protected $fillable = [
        'question_id',
        'exercise_id',
        'reply',
        'is_true'
    ];

    /**
     * @return BelongsTo
     */
    public function question(): BelongsTo
    {
        return $this->belongsTo(ExerciseListenAnswerQuestion::class)->withDefault();
    }

    /**
     * @return BelongsTo
     */
    public function exercise(): BelongsTo
    {
        return $this->belongsTo(Exercise::class)->withDefault();
    }
}
