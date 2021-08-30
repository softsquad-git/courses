<?php

namespace App\Models\Courses\Exercises;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @package App\Models\Courses\Exercises
 * @property int exercise_id
 * @property string txt
 * @property string txt_trans
 * @property string image
 * @property string sound_file
 */
class ExerciseFlashcard extends Model
{
    use HasFactory;

    /**
     * @var string
     */
    protected $table = 'exercise_flashcard';

    /**
     * @var string[] $fillable
     */
    protected $fillable = [
        'exercise_id',
        'txt',
        'txt_trans',
        'image',
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
