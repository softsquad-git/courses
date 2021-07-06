<?php

namespace App\Models\Courses\Exercises;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @package App\Models\Courses\Exercises
 * @method static create(array $data)
 * @property int exercise_id
 * @property string image
 * @property string sound_file
 * @property string txt
 * @property string txt_trans
 */
class ExerciseListenAnswerQuestion extends Model
{
    use HasFactory;

    /**
     * @var string $table
     */
    protected $table = 'exercise_listen_answer_question';

    /**
     * @var string[] $fillable
     */
    protected $fillable = [
        'exercise_id',
        'image',
        'sound_file',
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

    /**
     * @return HasMany
     */
    public function answers(): HasMany
    {
        return $this->hasMany(ExerciseListenAnswerQuestionAnswer::class, 'question_id');
    }
}
