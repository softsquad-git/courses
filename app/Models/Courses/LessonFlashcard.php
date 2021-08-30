<?php

namespace App\Models\Courses;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @package App\Models\Courses
 * @property int lesson_id
 * @property string txt
 * @property string txt_trans
 * @property string image
 * @property string sound_file
 */
class LessonFlashcard extends Model
{
    use HasFactory;

    /**
     * @var string $table
     */
    protected $table = 'lesson_flashcards';

    /**
     * @var string $fileImageDir
     */
    public static string $fileImageDir = 'assets/data/media/lessons/flashcards/images/';

    /**
     * @var string $fileSoundDir
     */
    public static string $fileSoundDir = 'assets/data/media/lessons/flashcards/sounds/';

    /**
     * @var string[] $fillable
     */
    protected $fillable = [
        'lesson_id',
        'txt',
        'txt_trans',
        'image',
        'sound_file'
    ];

    /**
     * @return BelongsTo
     */
    public function lesson(): BelongsTo
    {
        return $this->belongsTo(Lesson::class)->withDefault();
    }

    /**
     * @return string|null
     */
    public function getImage(): ?string
    {
        if ($this->image) {
            return asset(self::$fileImageDir.$this->image);
        }

        return null;
    }

    /**
     * @return string|null
     */
    public function getSoundFile(): ?string
    {
        if ($this->sound_file) {
            return asset(self::$fileSoundDir.$this->sound_file);
        }

        return null;
    }
}
