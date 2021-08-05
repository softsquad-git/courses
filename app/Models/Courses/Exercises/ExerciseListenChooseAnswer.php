<?php

namespace App\Models\Courses\Exercises;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @package App\Models\Courses\Exercises
 * @property string sound_file
 * @property int exercise_id
 */
class ExerciseListenChooseAnswer extends Model
{
    use HasFactory;

    /**
     * @var string $table
     */
    protected $table = 'exercise_listen_choose_answer';

    /**
     * @var string[] $fillable
     */
    protected $fillable = [
        'sound_file',
        'exercise_id'
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

    /**
     * @return string|null
     */
    public function getSoundFile(): ?string
    {
        if ($this->sound_file) {
            return asset(Exercise::$fileSoundDir.$this->sound_file);
        }

        return null;
    }

}
