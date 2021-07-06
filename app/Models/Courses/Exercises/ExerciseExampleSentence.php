<?php

namespace App\Models\Courses\Exercises;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @package App\Models\Courses\Exercises
 * @property int exercise_id
 * @property string txt
 * @property string txt_trans
 * @property string sentence
 * @property string sentence_trans
 * @property string|null sound_file
 */
class ExerciseExampleSentence extends Model
{
    use HasFactory;

    /**
     * @var string $table
     */
    protected $table = 'exercise_example_sentences';

    /**
     * @var string[] $fillable
     */
    protected $fillable = [
        'exercise_id',
        'txt',
        'txt_trans',
        'sentence',
        'sentence_trans',
        'sound_file'
    ];

    /**
     * @return string
     */
    public function exercise(): string
    {
        return $this->belongsTo(Exercise::class);
    }

    /**
     * @return HasMany
     */
    public function answers(): HasMany
    {
        return $this->hasMany(ExerciseListenAnswerQuestionAnswer::clas
        , 'question_id', __('id'))
            ->where(['question_id' => $this->exercise_id]);
    }
}
