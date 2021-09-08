<?php

namespace App\Models\Courses\Exercises;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property int id
 * @property int exercise_id
 * @property string sentence
 * @property string sentence_trans
 */
class ExerciseCompleteSentence extends Model
{
    use HasFactory;

    /**
     * @var string $table
     */
    protected $table = 'exercise_complete_sentence';

    /**
     * @var string[] $fillable
     */
    protected $fillable = [
        'exercise_id',
        'sentence',
        'sentence_trans'
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
        return $this->hasMany(ExerciseListenAnswerQuestionAnswer::class, 'question_id', 'id')
            ->where(['exercise_id' => $this->exercise_id]);
    }
}
