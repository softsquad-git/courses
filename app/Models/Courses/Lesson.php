<?php

namespace App\Models\Courses;

use App\Models\Courses\Exercises\Exercise;
use App\Models\Lessons\EndLessonPage;
use App\Models\Users\UserAudio;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Facades\Auth;

/**
 * @package App\Models\Courses
 * @property string name
 * @property int course_id
 * @property string|null description
 * @property float|null time
 * @property string image
 * @property int position
 * @property string lesson_time
 * @method static find(int $lessonId)
 * @method static where(string $string, int $courseId)
 * @property int id
 * @property string|null file_audio
 * @property string|null time_file_audio
 * @property string|null sub_title
 */
class Lesson extends Model
{
    use HasFactory;

    /**
     * @var string $fileDir
     */
    public static string $fileDir = 'assets/media/courses/lessons/';

    /**
     * @var string $fileDirAudio
     */
    public static string $fileDirAudio = 'assets/media/courses/lessons/audio/';

    /**
     * @var string $table
     */
    protected $table = 'lessons';

    /**
     * @var string[] $fillable
     */
    protected $fillable = [
        'name',
        'description',
        'course_id',
        'time',
        'image',
        'position',
        'is_premium',
        'speech_bubble',
        'lesson_time',
        'file_audio',
        'time_file_audio',
        'sub_title'
    ];

    /**
     * @return BelongsTo
     */
    public function course(): BelongsTo
    {
        return $this->belongsTo(Course::class)->withDefault();
    }

    /**
     * @return string
     */
    public function getImage(): string
    {
        if ($this->image) {
            return asset(self::$fileDir . $this->image);
        }

        return asset(self::$fileDir . 'df.png');
    }

    /**
     * @return HasMany
     */
    public function exercises(): HasMany
    {
        return $this->hasMany(Exercise::class, 'lesson_id');
    }

    /**
     * @return HasMany
     */
    public function flashcards(): HasMany
    {
        return $this->exercises()->where([
            'type' => Exercise::$types['FLASHCARD']
        ]);
    }

    /**
     * @return string|null
     */
    public function getAudio(): ?string
    {
        if ($this->file_audio) {
            return asset(self::$fileDirAudio.$this->file_audio);
        }

        return null;
    }

    /**
     * @return HasOne
     */
    public function isAddedAudio(): HasOne
    {
        return $this->hasOne(UserAudio::class, 'lesson_id', 'id')
            ->where('user_id', Auth::id())
            ->withDefault();
    }

    /**
     * @return HasOne
     */
    public function endLesson(): HasOne
    {
        return $this->hasOne(EndLessonPage::class, 'lesson_id')
            ->withDefault();
    }
}
