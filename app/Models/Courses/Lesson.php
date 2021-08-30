<?php

namespace App\Models\Courses;

use App\Models\Courses\Exercises\Exercise;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @package App\Models\Courses
 * @property string name
 * @property int course_id
 * @property string|null description
 * @property float|null time
 * @property string image
 * @property int position
 * @method static find(int $lessonId)
 * @method static where(int[] $array)
 */
class Lesson extends Model
{
    use HasFactory;

    /**
     * @var string $fileDir
     */
    public static string $fileDir = 'assets/media/courses/lessons/';

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
        'is_premium'
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
}
