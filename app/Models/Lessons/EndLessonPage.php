<?php

namespace App\Models\Lessons;

use App\Models\Courses\Lesson;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int id
 * @property  int|null lesson_id
 * @property string title
 * @property string sub_title
 * @property string description
 * @property string image
 * @property Lesson|null lesson
 * @method static find(int $id)
 * @method static create(array $data)
 * @method static where(array $filters)
 */
class EndLessonPage extends Model
{
    use HasFactory;

    /**
     * @var string $table
     */
    protected $table = 'end_lessons_page';

    /**
     * @var string[] $fillable
     */
    protected $fillable = [
        'lesson_id',
        'title',
        'sub_title',
        'description',
        'image'
    ];

    /**
     * @var string $fileDir
     */
    public static string $fileDir = 'assets/media/courses/lessons/end/';

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
            return asset(self::$fileDir . $this->image);
        }

        return null;
    }
}
