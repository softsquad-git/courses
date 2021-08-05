<?php

namespace App\Models\Courses\Exercises;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @package App\Models\Courses\Exercises
 * @property int exercise_id
 * @property string image
 * @property string txt
 * @property string|null sound_file
 */
class ExerciseImageAnswer extends Model
{
    use HasFactory;

    /**
     * @var string $table
     */
    protected $table = 'exercise_image_answer';

    /**
     * @var string[] $fillable
     */
    protected $fillable = [
        'exercise_id',
        'image',
        'txt',
        'sound_file'
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
        return $this->hasMany(ExerciseListenAnswerQuestionAnswer::class, 'question_id')
            ->where('exercise_id', $this->exercise_id);
    }

    /**
     * @return string|null
     */
    public function getImage(): ?string
    {
        if ($this->image) {
            return asset(Exercise::$fileImageDir.$this->image);
        }

        return null;
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
